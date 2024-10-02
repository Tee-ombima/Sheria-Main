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
            'name' => 'required|string|max:255',
        ]);

        // Create and save department
        Department::create($request->only('name'));

        // Redirect with success message
        return redirect()->route('admin.departments.index')->with('success', 'Department created successfully.');
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
        ]);

        $department = Department::findOrFail($id);
        $department->update($request->only('name'));

        return redirect()->route('admin.departments.index')->with('success', 'Department updated successfully.');
    }
    // Archive a department
    public function archive($id)
    {
        $department = Department::findOrFail($id);
        $department->archived = true;
        $department->save();

        return redirect()->route('admin.departments.index')->with('success', 'Department archived successfully.');
    }

    // Unarchive a department
    public function unarchive($id)
    {
        $department = Department::findOrFail($id);
        $department->archived = false;
        $department->save();

        return redirect()->route('admin.departments.index')->with('success', 'Department unarchived successfully.');
    }

    // Soft delete a department
    public function destroy($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();

        return redirect()->route('admin.departments.index')->with('success', 'Department deleted successfully.');
    }

    // Show archived departments
    public function archived()
    {
        $departments = Department::onlyTrashed()->get();

        return view('admin.departments.archived', compact('departments'));
    }
}
