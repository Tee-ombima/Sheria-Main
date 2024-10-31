<?php
// app/Http/Controllers/AdminInternshipController.php
namespace App\Http\Controllers;

use App\Models\InternshipApplication;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserAssignedToDepartmentMail;

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
        $query = InternshipApplication::with('user', 'department')
            ->where('status', 'Pending');

        // Apply Assignment Filter
        $assignmentFilter = $request->input('assignment_filter');

        if ($assignmentFilter == 'assigned') {
            $query->whereNotNull('department_id');
        } elseif ($assignmentFilter == 'not_assigned') {
            $query->whereNull('department_id');
        }

        $applications = $query->paginate(10);

        return view('admin.internships.index', compact('applications'));
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

    $application->update([
        'status' => $request->status,
        'department_id' => $request->department_id,
    ]);

    // If a department is assigned, send emails
    if ($request->department_id) {
        $department = Department::find($request->department_id);
        $departmentEmails = explode(',', $department->email); // Assuming multiple emails are comma-separated
        $user = $application->user;

        // Send email to department emails
        foreach ($departmentEmails as $email) {
            Mail::to(trim($email))->send(new UserAssignedToDepartmentMail($user, $department, $application));
        }
    }

    return redirect()->back()->with('message', 'Application updated successfully.');
}

public function destroy(InternshipApplication $application)
{
    // You can choose to just delete the application or change its status to inactive
    $application->delete();

    return back()->with(    'message','Application removed successfully!');
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

}
