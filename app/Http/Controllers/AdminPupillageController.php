<?php

// app/Http/Controllers/AdminPupillageController.php

namespace App\Http\Controllers;

use App\Models\Pupillage;
use App\Models\Department;
use Illuminate\Http\Request;

class AdminPupillageController extends Controller
{
    /**
     * Display a listing of pending pupillage applications.
     */
    public function index(Request $request)
    {
        $query = Pupillage::with('user', 'department')
            ->where('status', 'Pending');

        // Apply Assignment Filter
        $assignmentFilter = $request->input('assignment_filter');

        if ($assignmentFilter == 'assigned') {
            $query->whereNotNull('department_id');
        } elseif ($assignmentFilter == 'not_assigned') {
            $query->whereNull('department_id');
        }

        $applications = $query->paginate(10);

        return view('admin.pupillages.index', compact('applications'));
    }

    /**
     * Show the form for creating a new department (if applicable).
     */
    public function storeDepartment(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        Department::create([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return back()->with('message', 'Department added successfully!');
    }

    /**
     * Display the specified application.
     */
    public function show($id)
    {
        $application = Pupillage::with('user')->findOrFail($id);
        $departments = Department::all();

        return view('admin.pupillages.show', compact('application', 'departments'));
    }

    /**
     * Update the specified application.
     */
    public function update(Request $request, Pupillage $application)
    {
        $request->validate([
            'status' => 'required|in:Pending,Accepted,Not_Successful,Removed',
            'department_id' => 'nullable|exists:departments,id',
        ]);

        $application->update([
            'status' => $request->status,
            'department_id' => $request->department_id,
        ]);

        // Send email logic (if needed)

        return redirect()->back()->with('message', 'Application updated successfully.');
    }

    /**
     * Remove the specified application.
     */
    public function destroy(Pupillage $application)
    {
        $application->delete();

        return back()->with('message', 'Application removed successfully!');
    }

    /**
     * Archive the specified application.
     */
    public function archive(Pupillage $application)
    {
        $application->update(['status' => 'Archived']);

        return redirect()->back()->with('message', 'Application archived successfully.');
    }

    /**
     * Display archived applications.
     */
    public function archivedApplications()
    {
        $applications = Pupillage::where('status', 'Archived')->paginate(10);

        return view('admin.pupillages.archived', compact('applications'));
    }

    /**
     * Unarchive the specified application.
     */
    public function unarchive(Pupillage $application)
    {
        $application->update(['status' => 'Pending']);

        return redirect()->back()->with('message', 'Application unarchived successfully.');
    }

    /**
     * Display a listing of non-pending pupillage applications.
     */
    public function nonPending()
    {
        $applications = Pupillage::with('user')
            ->where('status', '!=', 'Pending')
            ->paginate(10);

        return view('admin.pupillages.nonPending', compact('applications'));
    }
}
