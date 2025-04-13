<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
   
    // Show form to create a department
    public function create()
    {
        return view('admin.departments.create'); // Return the view for creating a department
    }

    // Store a new department
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255|unique:departments,name',
// In DepartmentController's store and update methods
'email' => [
    'required',
    'max:255',
    function ($attribute, $value, $fail) {
        $emails = explode(',', $value);
        foreach ($emails as $email) {
            if (!filter_var(trim($email), FILTER_VALIDATE_EMAIL)) {
                $fail("The $attribute contains an invalid email address: " . trim($email));
            }
        }
    },
    // For store method, include unique rule
    'unique:departments,email',
],
        ]);

        // Create and save department
        Department::create($request->only('name','email'));
        $department = Department::create($request->only('name','email'));
activity()
    ->causedBy(auth()->user())
    ->performedOn($department)
    ->withProperties([
        'admin_email' => auth()->user()->email,
        'department_email' => $request->email
    ])
    ->log('New department created');

        // Redirect with success message
        return redirect()->route('admin.departments.index')->with('message', 'Department created successfully.');
    }

    // Other methods (index, edit, etc.)
    // List all departments (index method)
    public function index()
    {
        // Fetch all departments from the database
        $departments = Department::all();

        // Return the view for listing departments, passing the departments to the view
        return view('admin.departments.index', compact('departments'));
    }
    // Show the form to edit a department
    public function edit($id)
    {
        $department = Department::findOrFail($id);
        return view('admin.departments.edit', compact('department'));
    }

    // Update the department
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255', // Add email validation

        ]);

        $department = Department::findOrFail($id);
        $department->update($request->only('name','email'));

        return redirect()->route('admin.departments.index')->with('message', 'Department updated successfully.');
    }
    // Archive a department
    public function archive($id)
    {
        $department = Department::findOrFail($id);
        $department->archived = true;
        $department->save();

        return redirect()->route('admin.departments.index')->with('message', 'Department archived successfully.');
    }

    // Unarchive a department
    public function unarchive($id)
    {
        $department = Department::findOrFail($id);
        $department->archived = false;
        $department->save();

        return redirect()->route('admin.departments.index')->with('message', 'Department unarchived successfully.');
    }

    // Soft delete a department
    public function destroy($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();

        return redirect()->route('admin.departments.index')->with('message', 'Department deleted successfully.');
    }

    // Show archived departments
    public function archived()
    {
        $departments = Department::onlyTrashed()->get();

        return view('admin.departments.archived', compact('departments'));
    }
}
