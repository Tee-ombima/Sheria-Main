<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail; // Add this at the top
use App\Mail\ApplicationSubmitted;

use App\Models\Listing;
use Illuminate\Http\Request;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;
use App\Models\PersonalInfo;
use App\Models\AcademicInfo;
use App\Models\ProfInfo;
use App\Models\User;

use App\Models\RelevantCourses;
use Illuminate\Support\Facades\Log;
class ApplicationController extends Controller
{
    public function index()
    {
        // Paginate the results, showing 10 applications per page
        $applications = Application::where('user_id', Auth::id())
            ->with('listing')
            ->orderBy('created_at', 'desc')  // Add this line

            ->paginate(5); // Change get() to paginate(10)

        return view('applications.index', compact('applications'));
    }
    public function apply(Request $request, $id)
    {
        $listing = Listing::findOrFail($id);
        $userId = Auth::id();
    
        // Check if the listing is active and the deadline has not passed
        if (!$listing->isActive || $listing->deadline->isPast()) {
            return redirect()->back()->with('error', 'This job is no longer accepting applications.');
        }
    
        // Check if all required sections are completed
        $personalInfoCompleted = PersonalInfo::where('user_id', $userId)->exists();
        $academicInfoCompleted = AcademicInfo::where('user_id', $userId)->exists();
        $profInfoCompleted = ProfInfo::where('user_id', $userId)->exists();
        $relevantCoursesCompleted = RelevantCourses::where('user_id', $userId)->exists();
    
        if (!$personalInfoCompleted || !$academicInfoCompleted || !$profInfoCompleted || !$relevantCoursesCompleted) {
            return redirect()->route('index')->with('message', 'Please complete your profile before applying.');
        }
    
        // Check if the user has already applied for this job
        $existingApplication = Application::where('user_id', $userId)->where('job_id', $listing->id)->first();
    
        if ($existingApplication) {
            return redirect()->back()->with('message', 'You have already applied for this job.');
        }
    
        try {
            // Fetch personal info
            $personalInfo = PersonalInfo::where('user_id', $userId)->first();
            $idno = $personalInfo->idno;
            $name = trim($personalInfo->firstname . ' ' . $personalInfo->lastname . ' ' . $personalInfo->surname);
    
            // Save application
            $application = new Application();
            $application->user_id = $userId;
            $application->job_id = $listing->id;
            $application->idno = $idno;
            $application->name = $name;
            $application->job_title = $listing->title;
            $application->job_reference_number = $listing->job_reference_number;
            $application->remarks = null;
            $application->job_status = 'Processing';
            $application->save();
      
    
    
            // Send email confirmation to the user
            Mail::to(Auth::user()->email)->send(new ApplicationSubmitted($application));
    
            return redirect()->back()->with('message', 'Application submitted successfully.');
        } catch (\Exception $e) {
            // Log the error and return a user-friendly message
            Log::error('Application submission failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while submitting your application. Please try again.');
        }
    
    }
    
}
