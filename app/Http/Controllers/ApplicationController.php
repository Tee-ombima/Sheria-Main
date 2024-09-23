<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;
use App\Models\PersonalInfo;
use App\Models\AcademicInfo;
use App\Models\ProfInfo;
use App\Models\RelevantCourses;
use Illuminate\Support\Facades\Log;
class ApplicationController extends Controller
{
    public function index()
    {
        $applications = Application::where('user_id', Auth::id())->with('listing')->get();

        return view('applications.index', compact('applications'));
    }
    public function apply(Request $request, $id)
    {
        $listing = Listing::findOrFail($id);
        $userId = Auth::id();

        // Check if all required sections are completed
        $personalInfoCompleted = PersonalInfo::where('user_id', $userId)->exists();
        $academicInfoCompleted = AcademicInfo::where('user_id', $userId)->exists();
        $profInfoCompleted = ProfInfo::where('user_id', $userId)->exists();
        $relevantCoursesCompleted = RelevantCourses::where('user_id', $userId)->exists();

        if (!$personalInfoCompleted || !$academicInfoCompleted || !$profInfoCompleted || !$relevantCoursesCompleted) {
            session()->flash('message', 'Please complete your profile before applying.');
            return redirect()->route('index');
        }

        // Check if the user has already applied for this job
        $existingApplication = Application::where('user_id', $userId)->where('job_id', $listing->id)->first();

        if ($existingApplication) {
            return redirect()->back()->with('message', 'You have already applied for this job.');
        }

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
        $application->job_title = $listing->title; // Assuming title is the job title
        $application->job_reference_number = $listing->job_reference_number;
        $application->remarks = null; // Add any remarks if needed
        $application->job_status = 'Processing'; // Default status
        $application->save();

        return redirect()->back()->with('message', 'Application submitted successfully.');
    }
    
}
