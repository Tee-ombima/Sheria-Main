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



public function show(Request $request, $id)
{
    // Get filter inputs
    $filterIdno = $request->input('filter_idno');
    $filterEmail = $request->input('filter_email');

    // Base query for applications
    $applicationsQuery = Application::with([
        'user.personalInfo.homeCounty',
        'user.personalInfo.constituency',
        'user.personalInfo.subcounty',
        'user.personalInfo',
        'user.academicInfo',
        'user.profInfo',
        'user.relevantCourses',
        'user.attachmentInfo'
    ])->where('job_id', $id);

    // Apply filters if present
if ($filterIdno) {
    $applicationsQuery->whereHas('user.personalInfo', function ($query) use ($filterIdno) {
        $query->where('idno', 'like', '%' . $filterIdno . '%');
    });
}


    if ($filterEmail) {
        $applicationsQuery->whereHas('user', function ($query) use ($filterEmail) {
            $query->where('email', 'like', '%' . $filterEmail . '%');
        });
    }

    // Clone the base query for counts
    $baseQueryForCounts = clone $applicationsQuery;

    // Paginate the results
    $applications = $applicationsQuery->paginate(13);

    // Fetch the listing
    $listing = Listing::findOrFail($id);

    // Count the applications by status
    $processingCount = (clone $baseQueryForCounts)->where('job_status', 'Processing')->count();
    $selectedCount = (clone $baseQueryForCounts)->where('job_status', 'Selected')->count();
    $appointedCount = (clone $baseQueryForCounts)->where('job_status', 'Appointed')->count();
    $rejectedCount = (clone $baseQueryForCounts)->where('job_status', 'Not_Successful')->count();

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
    // Validate the incoming request
    $validated = $request->validate([
        'application_id' => 'required|integer|exists:applications,id',
        'job_status' => 'required|string',
        'remarks' => 'nullable|string',
    ]);

    // Retrieve the application
    $application = Application::findOrFail($validated['application_id']);

    // Update the application
    $application->job_status = $validated['job_status'];
    $application->remarks = $validated['remarks'];
    $application->save();

    // Redirect back with a success message
    return redirect()->back()->with('message', 'Application updated successfully.');
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
    public function dashboard()
    {
        return view('admin.dashboard');
    }
}
