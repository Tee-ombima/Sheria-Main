<?php
// app/Http/Controllers/AdminController.php
// app/Http/Controllers/AdminController.php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ApplicationsExport;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\Application;
use App\Models\User;
use App\Models\PersonalInfo;
use App\Models\Subcounty;
use App\Models\Constituency;
use App\Models\Homecounty;
use Carbon\Carbon;




class AdminController extends Controller
{
    public function index(Request $request)
{
    // Fetch distinct values for filters
    $job_titles = Listing::distinct()->pluck('title');
    $homecounties = Homecounty::distinct()->pluck('name');
    $constituencies = Constituency::distinct()->pluck('name');
    $subcounties = Subcounty::distinct()->pluck('name');

    // Initialize query
    $query = Listing::query();

    // Apply filters
    if ($request->filled('job_title')) {
        $query->where('title', 'like', '%' . $request->job_title . '%');
    }

    if ($request->filled('homecounty')) {
        $query->whereHas('applications.user.personalInfo', function ($q) use ($request) {
            $q->where('homecounty', $request->homecounty);
        });
    }

    if ($request->filled('constituency')) {
        $query->whereHas('applications.user.personalInfo', function ($q) use ($request) {
            $q->where('constituency', $request->constituency);
        });
    }

    if ($request->filled('subcounty')) {
        $query->whereHas('applications.user.personalInfo', function ($q) use ($request) {
            $q->where('subcounty', $request->subcounty);
        });
    }

    if ($request->filled('gender')) {
        $query->whereHas('applications.user.personalInfo', function ($q) use ($request) {
            $q->where('gender', $request->gender);
        });
    }

    if ($request->filled('dob_from') && $request->filled('dob_to')) {
        $query->whereHas('applications.user.personalInfo', function ($q) use ($request) {
            $q->whereBetween('dob', [
                Carbon::parse($request->dob_from)->startOfDay(),
                Carbon::parse($request->dob_to)->endOfDay()
            ]);
        });
    }

    if ($request->filled('disability')) {
        $query->whereHas('applications.user.personalInfo', function ($q) use ($request) {
            $q->where('disability_question', $request->disability);
        });
    }

    // Set default page and perPage values
    $page = $request->input('page', 1);
    $perPage = 6;

    // Get the listings for the current page
    $listings = $query->skip(($page - 1) * $perPage)->take($perPage)->get();

    // Always load applications and related data
    foreach ($listings as $listing) {
        $listing->applications = $listing->applications()
            ->with(['user.personalInfo', 'user.academicInfo', 'user.profInfo', 'user.relevantCourses','user.attachmentInfo'])
            ->get();
    }

    // Check if the request is AJAX
    if ($request->ajax()) {
        return view('admin.partials.listings', compact('listings'))->render();
    }

    return view('admin.index', compact('listings', 'job_titles', 'homecounties', 'constituencies', 'subcounties'));
}






public function show($id)
{
    $listing = Listing::with([
        'applications.user.personalInfo', 
        'applications.user.academicInfo',
        'applications.user.profInfo',
        'applications.user.relevantCourses',
        'applications.user.attachmentInfo'
    ])->findOrFail($id);

    $applications = $listing->applications()->paginate(13);

    // Count the applications by status
    $processingCount = $listing->applications()->where('job_status', 'Processing')->count();
    $selectedCount = $listing->applications()->where('job_status', 'Selected')->count();
    $appointedCount = $listing->applications()->where('job_status', 'Appointed')->count();
    $rejectedCount = $listing->applications()->where('job_status', 'Rejected')->count();

    // Total sum of all counts
    $sumCount = $processingCount + $selectedCount + $appointedCount + $rejectedCount;

    return view('admin.show', compact(
        'listing',
        'applications',
        'processingCount',
        'selectedCount',
        'appointedCount',
        'rejectedCount',
        'sumCount'
    ));
}

public function updateStatus(Request $request)
{
    $validated = $request->validate([
        'status.*' => 'required|string',  // Status for each user
        'remarks.*' => 'nullable|string',  // Remarks for each user
        'job_id' => 'required|integer',    // The job ID to ensure we update the correct job
    ]);

    // Retrieve the job ID
    $jobId = $request->input('job_id');

    // Loop through each status and update the corresponding application
    foreach ($validated['status'] as $userId => $status) {
        $remarks = $validated['remarks'][$userId] ?? null;

        // Update the application for this user and job
        Application::where('user_id', $userId)
            ->where('job_id', $jobId)
            ->update([
                'job_status' => $status,
                'remarks' => $remarks,
            ]);
    }

    // Redirect back with a success message
    return redirect()->route('admin.show', ['job' => $jobId])->with('success', 'Statuses updated successfully.');
}



public function showSelectedForInterview(Request $request)
{
    $jobTitle = $request->input('job_title');
    $jobs = Listing::all();

    // Fetch applications with status "Selected"
    $applications = Application::where('job_status', 'Selected')
        ->when($jobTitle, function($query) use ($jobTitle) {
            return $query->whereHas('listing', function($q) use ($jobTitle) {
                $q->where('title', $jobTitle);
            });
        })
        ->with(['user.personalInfo', 'listing'])
        ->get();

    return view('admin.reports.selected', compact('applications', 'jobTitle', 'jobs'));
}

public function showAppointed(Request $request)
{
    $jobTitle = $request->input('job_title');
    $jobs = Listing::all();

    // Fetch applications with status "Appointed"
    $applications = Application::where('job_status', 'Appointed')
        ->when($jobTitle, function($query) use ($jobTitle) {
            return $query->whereHas('listing', function($q) use ($jobTitle) {
                $q->where('title', $jobTitle);
            });
        })
        ->with(['user.personalInfo', 'listing'])
        ->get();

    return view('admin.reports.appointed', compact('applications', 'jobTitle', 'jobs'));
}

    public function exportCSV(Request $request)
    {
        $type = $request->input('type');
        $jobId = $request->input('job_title');

        return Excel::download(new ApplicationsExport($type, $jobId), "{$type}_applications.csv");
    }

    public function exportPDF(Request $request)
    {
        $type = $request->input('type');
        $jobId = $request->input('job_title');

        $applications = Application::where('job_status', ucfirst($type))
            ->when($jobId, function($query) use ($jobId) {
                return $query->where('job_title', $jobId);
            })
            ->with(['user.personalInfo', 'listing'])
            ->get();

        $pdf = PDF::loadView('admin.reports.pdf', compact('applications', 'type'));
        return $pdf->download("{$type}_applications.pdf");
    }
}
