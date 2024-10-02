<?php
// app/Http/Controllers/AdminInternshipController.php
namespace App\Http\Controllers;

use App\Models\InternshipApplication;
use App\Models\Department;
use Illuminate\Http\Request;

class AdminInternshipController extends Controller
{
    /**
     * Show list of user applications for admin.
     */
    public function index()
{
    $departments = Department::with('applications')->get();
    return view('admin.internships.index', compact('departments'));
}

public function show(Department $department)
{
    // Paginate applications, e.g., 10 per page
    $applications = $department->applications()->paginate(10);
    return view('admin.internships.show', compact('department', 'applications'));
}


public function update(Request $request, InternshipApplication $application)
{
    $application->update([
        'status' => $request->status,
        'remarks' => $request->remarks,
    ]);
    session()->flash('message', 'Application updated successfully!');

    return back();
}

public function storeDepartment(Request $request)
{
    $request->validate(['name' => 'required|string|max:255']);
    Department::create(['name' => $request->name]);

    return back()->with('success', 'Department added successfully!');
}

}
