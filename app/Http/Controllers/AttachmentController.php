<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attachment;
use App\Models\DocumentName;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class AttachmentController extends Controller
{

public function showAttachmentForm()
{
    $userId = Auth::id();
    $attachments = Attachment::where('user_id', $userId)->get();
    $attachementInfoSubmitted = Attachment::where('user_id', $userId)->exists();

    $documentNames = DocumentName::all();

    return view('users.profile.attachments', [
        'attachments' => $attachments,
        'documentNames'=>$documentNames,
        'attachementInfoSubmitted' => $attachementInfoSubmitted,
       
        
    ]);
}

public function uploadAttachment(Request $request)
{
    $user_id = Auth::id();
    
    // Determine if the user selected "Other"
    $document_name = $request->document_name === 'other' 
        ? $request->custom_document_name 
        : $request->document_name;
    
    // Validate the input
    $validator = Validator::make($request->all(), [
        'document_name' => 'required_without:custom_document_name',
        'custom_document_name' => 'nullable|string|required_if:document_name,other',
        'file' => 'required|mimes:pdf|max:5120', // PDF only, max 5MB
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Check if the user has already uploaded this document
    if (Attachment::where('user_id', $user_id)->where('document_name', $document_name)->exists()) {
        return redirect()->back()->with('message','You have already uploaded this document.');
    }

    // Store the file
    $filePath = $request->file('file')->store('attachments', 'public');

    // Save to the database
    Attachment::create([
        'user_id' => $user_id,
        'document_name' => $document_name,
        'file_path' => $filePath,
    ]);
    
    return redirect()->back()->with('message','Document Saved successfully.');
}

public function editAttachment(Request $request)
{
    $user_id = Auth::id();

    // Validate the input
    $validator = Validator::make($request->all(), [
        'attachment_id' => 'required|exists:attachments,id',
        'edit_document_name' => 'required|string|max:255',
        'edit_file' => 'nullable|mimes:pdf|max:5120', // PDF only, max size 5MB
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Find the existing attachment
    $attachment = Attachment::where('id', $request->attachment_id)->where('user_id', $user_id)->firstOrFail();

    // If a new file is uploaded, handle file replacement
    if ($request->hasFile('edit_file')) {
        // Delete the old file from storage
        Storage::disk('public')->delete($attachment->file_path);

        // Store the new file
        $filePath = $request->file('edit_file')->store('attachments', 'public');

        // Update the attachment with the new file path
        $attachment->file_path = $filePath;
    }

    // Update the document name
    $attachment->document_name = $request->edit_document_name;

    // Save the updated attachment
    $attachment->save();

    return redirect()->back()->with('message','Document updated successfully.');
}

public function deleteAttachment($id)
{
    $attachment = Attachment::findOrFail($id);

    // Check ownership
    if ($attachment->user_id != Auth::id()) {
        abort(403, 'Unauthorized action.');
    }

    // Delete the file from storage
    Storage::disk('public')->delete($attachment->file_path);

    // Delete the record from the database
    $attachment->delete();

    return redirect()->back()->with('message','Attachment deleted successfully.');
}

public function saveAttachments(Request $request)
{
    $user_id = Auth::id();
    
    // Retrieve the rows from session
    $attachments = session()->get('attachments', []);
    
    if (empty($attachments)) {

        return redirect()->back()->with('message','Please upload at least one document');
    }

    // Validate each attachment
    foreach ($attachments as $attachment) {
        $validator = Validator::make($attachment, [
            'document_name' => 'required|exists:document_names,name',
            'file_path' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    // Save each attachment to the database
    foreach ($attachments as $attachment) {
        $attachment['user_id'] = $user_id; // Add the user_id to the attachment data
        Attachment::create($attachment);
    }

    // Clear the session
    session()->forget('attachments');

    // Redirect to the next step or back with a success message
    return redirect()->route('index')->with('message','Attachments were submitted successfully!');
}




}
