<?php
// app/Http/Controllers/InternshipController.php
namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\InternshipApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // For file storage operations
use App\Models\Pupillage;
use App\Models\PostPupillage;
use Illuminate\Support\Facades\Validator;
use App\Models\ApplicationSetting;

class InternshipController extends Controller
{
    /**
     * Show available departments for attachments.
     */
    public function create()
{
    $existingApplication = InternshipApplication::where('user_id', Auth::id())->first();

    if ($existingApplication) {
        return redirect()->route('internships.index')->with('message', 'You have already applied for an internship.');
    }
    if (!$this->internshipApplicationsEnabled()) {
        return redirect()->back()->with('message', 'No Attachment available at this time.');
    }


    return view('internships.create');
}

public function uploadFile(Request $request)
    {
        $fieldName = $request->file('id_file') ? 'id_file' :
                     ($request->file('university_letter') ? 'university_letter' :
                     ($request->file('application_letter') ? 'application_letter' :
                     ($request->file('insurance') ? 'insurance' :
                     ($request->file('good_conduct') ? 'good_conduct' :
                     ($request->file('cv') ? 'cv' : null)))));

        if (!$fieldName) {
            return response()->json(['success' => false, 'message' => 'No file uploaded.'], 400);
        }

        // Validate the file
        $validator = Validator::make($request->all(), [
            $fieldName => 'required|file|mimes:pdf|max:2048', 
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first($fieldName)], 400);
        }

        // Handle file upload
        $filePath = $request->file($fieldName)->store('internship_files', 'public');

        // Store the file path in the session
        $uploadedFiles = session()->get('uploaded_files', []);
        $uploadedFiles[$fieldName] = $filePath;
        session()->put('uploaded_files', $uploadedFiles);

        return response()->json(['success' => true]);
    }

    public function store(Request $request)
    {
        $existingApplication = InternshipApplication::where('user_id', Auth::id())->first();

        if ($existingApplication) {
            return redirect()->route('internships.index')->with('message', 'You have already applied for an internship.');
        }
        if (!$this->internshipApplicationsEnabled()) {
            return redirect()->back()->with('message', 'No Attachment available at this time.');
        }

        // Validate the remaining form data
        $request->validate([
            'full_name' => 'required|string|max:50',
            'phone' => 'required|integer',
            'institution' => 'required|string|max:50',
            'email' => 'required|email|max:50',
        ]);

        // Retrieve uploaded files from the session
        $uploadedFiles = session()->get('uploaded_files', []);

        // Check if all files have been uploaded
        $requiredFiles = ['id_file', 'university_letter', 'application_letter', 'insurance', 'good_conduct', 'cv'];
        foreach ($requiredFiles as $file) {
            if (!isset($uploadedFiles[$file])) {
                return back()->withErrors([$file => 'Please upload the ' . ucwords(str_replace('_', ' ', $file)) . '.']);
            }
        }

        // Create the Internship application
        InternshipApplication::create([
            'user_id' => Auth::id(),
            'full_name' => $request->full_name,
            'phone' => $request->phone,
            'institution' => $request->institution,
            'email' => $request->email,
            'id_file' => $uploadedFiles['id_file'],
            'university_letter' => $uploadedFiles['university_letter'],
            'application_letter' => $uploadedFiles['application_letter'],
            'insurance' => $uploadedFiles['insurance'],
            'good_conduct' => $uploadedFiles['good_conduct'],
            'cv' => $uploadedFiles['cv'],
            'status' => 'Pending',
        ]);

        // Clear the uploaded files from the session
        session()->forget('uploaded_files');

        return redirect()->route('internships.index')->with('message', 'Internship application submitted successfully.');
    }


public function index()
{
    // Retrieve internships applied by the authenticated user
    $internships = InternshipApplication::where('user_id', Auth::id())->paginate(10);
    $pupillages = Pupillage::where('user_id', Auth::id())->paginate(10);
    $postpupillages = PostPupillage::where('user_id', Auth::id())->paginate(10);


    return view('internships.index', compact('internships', 'pupillages','postpupillages'));
}



public function edit($id)
    {
        $internship = InternshipApplication::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('internships.edit', compact('internship'));
    }

    public function update(Request $request, $id)
{
    $internship = InternshipApplication::where('id', $id)
        ->where('user_id', Auth::id())
        ->firstOrFail();

    // Validate the request
    $request->validate([
        'full_name' => 'required|string|max:255',
        'phone' => 'required|integer',
        'institution' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'id_file' => 'nullable|file|mimes:pdf|max:2048',
        'university_letter' => 'nullable|file|mimes:pdf|max:2048',
        'application_letter' => 'nullable|file|mimes:pdf|max:2048',
        'insurance' => 'nullable|file|mimes:pdf|max:2048',
        'good_conduct' => 'nullable|file|mimes:pdf|max:2048',
        'cv' => 'nullable|file|mimes:pdf|max:2048',
    ]);

    // Update the internship application
    $internship->update([
        'full_name' => $request->full_name,
        'phone' => $request->phone,
        'institution' => $request->institution,
        'email' => $request->email,
    ]);

    // Handle file uploads only if a new file is uploaded
    if ($request->hasFile('id_file')) {
        if ($internship->id_file) {
            Storage::disk('public')->delete($internship->id_file);
        }
        $internship->id_file = $request->file('id_file')->store('internship_files', 'public');
    }

    if ($request->hasFile('university_letter')) {
        if ($internship->university_letter) {
            Storage::disk('public')->delete($internship->university_letter);
        }
        $internship->university_letter = $request->file('university_letter')->store('internship_files', 'public');
    }

    if ($request->hasFile('application_letter')) {
        if ($internship->application_letter) {
            Storage::disk('public')->delete($internship->application_letter);
        }
        $internship->application_letter = $request->file('application_letter')->store('internship_files', 'public');
    }

    if ($request->hasFile('insurance')) {
        if ($internship->insurance) {
            Storage::disk('public')->delete($internship->insurance);
        }
        $internship->insurance = $request->file('insurance')->store('internship_files', 'public');
    }

    if ($request->hasFile('good_conduct')) {
        if ($internship->good_conduct) {
            Storage::disk('public')->delete($internship->good_conduct);
        }
        $internship->good_conduct = $request->file('good_conduct')->store('internship_files', 'public');
    }

    if ($request->hasFile('cv')) {
        if ($internship->cv) {
            Storage::disk('public')->delete($internship->cv);
        }
        $internship->cv = $request->file('cv')->store('internship_files', 'public');
    }

    $internship->save();

    return redirect()->route('internships.index')->with('message', 'Internship application updated successfully.');
}


    public function destroy($id)
    {
        // Find the internship application by ID and ensure it belongs to the authenticated user
        $internship = InternshipApplication::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
    
        // Delete associated files if they exist
        if ($internship->id_file) {
            Storage::disk('public')->delete($internship->id_file);
        }
        if ($internship->university_letter) {
            Storage::disk('public')->delete($internship->university_letter);
        }
        if ($internship->application_letter) {
            Storage::disk('public')->delete($internship->application_letter);
        }
        if ($internship->insurance) {
            Storage::disk('public')->delete($internship->insurance);
        }
        if ($internship->good_conduct) {
            Storage::disk('public')->delete($internship->good_conduct);
        }
        if ($internship->cv) {
            Storage::disk('public')->delete($internship->cv);
        }
    
        // Delete the internship application
        $internship->delete();
    
        // Redirect to the internship index page with a success message
        return redirect()->route('internships.index')->with('message', 'Internship application deleted successfully.');
    }
    private function internshipApplicationsEnabled()
{
    $applicationSetting = ApplicationSetting::first();
    return $applicationSetting && $applicationSetting->internship_applications_enabled;
}


}
