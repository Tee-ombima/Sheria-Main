<?php
// app/Http/Controllers/AdminInternshipController.php
namespace App\Http\Controllers;
use App\Models\ApplicationSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\InternshipApplicationSetting;
use Illuminate\Support\Facades\Cache;
use App\Mail\ApplicationAcceptedNotification;
use App\Models\User;

use App\Models\InternshipApplication;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserAssignedToDepartmentMail;
use App\Exports\InternshipApplicationsExport;
use Maatwebsite\Excel\Facades\Excel;
class AdminInternshipController extends Controller
{
    
public function archive(InternshipApplication $application)
{
    // Change the status to 'Archived'
    $application->update(['status' => 'Archived']);

    return redirect()->back()->with('message', 'Application archived successfully.');
}

// Adjust the index method to exclude archived applications
// app/Http/Controllers/AdminInternshipController.php
public function index(Request $request)
{
    $query = InternshipApplication::with(['user', 'department'])
        ->when($request->search_email, function($q) use ($request) {
            $q->whereHas('user', function($subQuery) use ($request) {
                $subQuery->where('email', 'like', '%'.$request->search_email.'%');
            });
        })
        ->when($request->assignment_filter, function($q) use ($request) {
            if ($request->assignment_filter === 'assigned') {
                $q->whereNotNull('department_id');
            } elseif ($request->assignment_filter === 'not_assigned') {
                $q->whereNull('department_id');
            }
        })
        // New status filter
        ->when($request->status_filter, function($q) use ($request) {
            $q->where('status', $request->status_filter);
        });

    // Optimized count with caching
    $showTotal = !$request->hasAny(['search_email', 'assignment_filter']);
    $totalApplications = $showTotal ? Cache::remember('internship_count', now()->addHours(6), function() {
        return InternshipApplication::count();
    }) : null;

    return view('admin.internships.index', [
        'applications' => $query->paginate(10),
        'showTotal' => $showTotal,
        'totalApplications' => $totalApplications
    ]);
}
    public function nonPending()
    {
        $applications = InternshipApplication::with('user')
            ->where('status', '!=', 'Pending')
            ->paginate(10);

        return view('admin.internships.nonPending', compact('applications'));
    }


// Modify the show method to exclude archived applications
public function show($id)
{
    $application = InternshipApplication::with('user')->findOrFail($id);
    $departments = Department::all();
    return view('admin.internships.show', compact('application', 'departments'));
}


// Add a new method to display archived applications
public function archivedApplications()
{
    $archivedApplications = InternshipApplication::where('status', 'Archived')->paginate(10);

    return view('admin.internships.archived', compact('archivedApplications'));
}
// Unarchive an application
public function unarchive(InternshipApplication $application)
{
    // Update the status to something other than 'Archived'
    $application->update(['status' => 'Pending']); // You can change this to any default status

    return redirect()->back()->with('message', 'Application unarchived successfully.');
}



public function update(Request $request, InternshipApplication $application)
{
    $request->validate([
        'status' => 'required|in:Pending,Accepted,Not_Successful',
        'department_id' => 'nullable|exists:departments,id',
    ]);

    $originalStatus = $application->status;
    
    $application->update([
        'status' => $request->status,
        'department_id' => $request->department_id,
    ]);
    $user = $application->user; // Assuming 'user' is a relationship in InternshipApplication

    // Notify department if assigned
    // In your update method
if ($request->department_id) {
    $department = Department::find($request->department_id);
    // Split, trim, and filter emails
    $departmentEmails = array_filter(array_map('trim', explode(',', $department->email)));
    
    foreach ($departmentEmails as $email) {
        Mail::to($email)->send(new UserAssignedToDepartmentMail($user, $department, $application));
    }
}

    

    return redirect()->route('admin.internships.index')->with('message', 'Application updated successfully.');
}

// Add this in your AdminInternshipController (or relevant controller)
public function destroy($id)
{
    $application = InternshipApplication::findOrFail($id);
    
    
    // Prevent deletion if status is Pending
    if ($application->status === 'Pending') {
        return redirect()->back()->with('error', 'Cannot delete application with Pending status.');
    }
    
    // Delete associated files
    $files = ['id_file', 'university_letter', 'application_letter', 'insurance', 'good_conduct', 'cv'];
    foreach ($files as $file) {
        if ($application->$file) {
            Storage::disk('public')->delete($application->$file);
        }
    }
    
    // Mark as deleted by admin and soft delete
    $application->deleted_by_admin = true;
    $application->save();
    $application->delete();
    activity()
    ->causedBy(auth()->user())
    ->performedOn($application)
    ->withProperties([
        'admin_email' => auth()->user()->email,
        'applicant_email' => $application->email_address,
        'status' => $application->status
    ])
    ->log('Application deleted');
    return redirect()->route('admin.internships.index')
        ->with('message', 'Application deleted successfully');
}




public function storeDepartment(Request $request)
{
    $request->validate(['name' => 'required|string|max:255']);
    Department::create([
        'name' => $request->name,
        'email' => $request->email,
    
    ]

);

    return back()->with('message', 'Department added successfully!');
}

public function accepted()
    {
        $applications = InternshipApplication::where('status', 'Accepted')->paginate(10);

        return view('admin.internships.accepted', compact('applications'));
    }

    public function notAccepted()
    {
        $applications = InternshipApplication::where('status', 'Not_Successful')->paginate(10);

        return view('admin.internships.not_accepted', compact('applications'));
    }

    public function export()
    {
        return Excel::download(new InternshipApplicationsExport, 'accepted_internship_applications.xlsx');
    }
    // In your Admin controller
    public function toggleApply()
    {
        // Only allow admins
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized Action');
        }

        $setting = ApplicationSetting::first();
        $setting->internship_applications_enabled = !$setting->internship_applications_enabled;
        $setting->save();

        return redirect()->back()->with('message', 'Attachement application status updated.');
    }
// In your Admin controller
// In your AdminController method that serves the view
// In AdminController
public function editSettings()
{
    $settings = InternshipApplicationSetting::first();
    
    return view('admin.settings.edit', compact('settings'));
}

public function updateSettings(Request $request)
{
    $validated = $request->validate([
        'max_pending_applications' => 'required|integer|min:1',
    ]);

    $settings = InternshipApplicationSetting::first();
    $oldValue = $settings->max_pending_applications;
    $settings->update($validated);

    return redirect()->route('admin.settings.edit')
        ->with('message', "Capacity updated from {$oldValue} to {$settings->max_pending_applications} successfully!");
}
}
