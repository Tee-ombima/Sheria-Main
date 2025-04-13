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
use App\Models\InternshipApplicationSetting;
use Illuminate\Support\Facades\DB; // Add this import

class InternshipController extends Controller
{
    /**
     * Show available departments for attachments.
     */
    public function create()
    {
        $settings = InternshipApplicationSetting::first();
        $currentPending = InternshipApplication::where('status', 'pending')->count();
    
        if ($currentPending >= $settings->max_pending_applications) {
            return redirect()->route('internships.index')
                ->with('message', 'Application submissions are currently paused. Maximum capacity reached.');
        }
        // Check for existing non-deleted application
        $existingApplication = InternshipApplication::where('user_id', Auth::id())->first();
        if ($existingApplication) {
            return redirect()->route('internships.index')->with('message', 'You have already applied for an internship.');
        }
    
        // Check if user was blocked by admin deletion
        $deletedByAdmin = InternshipApplication::withTrashed()
            ->where('user_id', Auth::id())
            ->where('deleted_by_admin', true)
            ->exists();
        if ($deletedByAdmin) {
            return redirect()->route('internships.index')->with('message', 'You cannot apply again as your previous application was already processed.');
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
        DB::transaction(function () use ($request) {

        $settings = InternshipApplicationSetting::lockForUpdate()->first();
    $currentCount = InternshipApplication::where('status', 'pending')->count();
    
    if ($currentCount >= $settings->max_pending_applications) {
        return redirect()->back()->withErrors([
            'limit' => 'We are no longer accepting Applications.'
        ]);
    }
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
    });
        // Clear the uploaded files from the session
        session()->forget('uploaded_files');
        

        return redirect()->route('internships.index')->with('message', 'Internship application submitted successfully.');
    }


public function index()
{
    // Retrieve internships applied by the authenticated user
    $internships = InternshipApplication::withTrashed()
        ->where('user_id', Auth::id())
        ->paginate(10);
        $pupillages = Pupillage::withTrashed()
        ->where('user_id', Auth::id())
        ->paginate(10);
        $postpupillages = PostPupillage::withTrashed()
        ->where('user_id', Auth::id())
        ->paginate(10);


    return view('internships.index', compact('internships', 'pupillages','postpupillages'));
}

    

    
    private function internshipApplicationsEnabled()
{
    $applicationSetting = ApplicationSetting::first();
    return $applicationSetting && $applicationSetting->internship_applications_enabled;
}


}
