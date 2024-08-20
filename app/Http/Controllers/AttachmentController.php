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
    
    // Validate the input
    $validator = Validator::make($request->all(), [
        'document_name' => 'required|exists:document_names,name',
        'file' => 'required|mimes:pdf|max:10240', // PDF only, max 10MB
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Check if the user has already uploaded this document
    if (Attachment::where('user_id', $user_id)->where('document_name', $request->document_name)->exists()) {
        return redirect()->back()->withErrors(['file' => 'You have already uploaded this document.'])->withInput();
    }

    // Store the file
    $filePath = $request->file('file')->store('attachments', 'public');

    // Save to the database
    Attachment::create([
        'user_id' => $user_id,
        'document_name' => $request->document_name,
        'file_path' => $filePath,
    ]);

    return redirect()->back()->with('success', 'Document uploaded successfully.');
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

    return redirect()->back()->with('success', 'Attachment deleted successfully.');
}

public function saveAttachments(Request $request)
{
    $user_id = Auth::id();
    
    // Retrieve the rows from session
    $attachments = session()->get('attachments', []);
    
    if (empty($attachments)) {
        return redirect()->back()->withErrors(['attachments' => 'Please upload at least one document before submitting.'])->withInput();
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
    session()->flash('message', 'Attachments were submitted successfully!');
    return redirect()->route('index'); // Change this to the next step in your flow
}




}
