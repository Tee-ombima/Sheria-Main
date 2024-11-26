<?php

// app/Http/Controllers/AdminPupillageController.php

namespace App\Http\Controllers;
use App\Models\ApplicationSetting;
use Illuminate\Support\Facades\Auth;

use App\Models\Pupillage;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Exports\PupillageExport;
use Maatwebsite\Excel\Facades\Excel;
class AdminPupillageController extends Controller
{
    /**
     * Display a listing of pending pupillage applications.
     */
    public function index(Request $request)
    {
        $query = Pupillage::with('user')
            ->where('status', 'Pending');

        

        $applications = $query->paginate(10);

        return view('admin.pupillages.index', compact('applications'));
    }

    
    

    /**
     * Display the specified application.
     */
    public function show($id)
    {
        $pupillage = Pupillage::with('user')->findOrFail($id);

        return view('admin.pupillages.show', compact('pupillage'));
    }

    /**
     * Update the specified application.
     */
    public function update(Request $request, Pupillage $application)
    {
        $request->validate([
            'status' => 'required|in:Pending,Accepted,Not_Successful,Removed',
        ]);

        $application->update([
            'status' => $request->status,
        ]);

        // Send email logic (if needed)

        return redirect()->route('admin.pupillages.index')->with('message', 'Application updated successfully.');
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

    // In PupillageController
public function accepted()
{
    $applications = Pupillage::where('status', 'Accepted')->paginate(15);
    return view('admin.pupillages.accepted', compact('applications'));
}

    public function notAccepted()
    {
        $applications = Pupillage::where('status', 'Not_Successful')->paginate(10);

        return view('admin.pupillages.not_accepted', compact('applications'));
    }

    public function export()
    {
        return Excel::download(new PupillageExport, 'pupillage.xlsx');
    }

    public function toggleApply()
    {
        // Only allow admins
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized Action');
        }

        $setting = ApplicationSetting::first();
        $setting->pupillage_applications_enabled = !$setting->pupillage_applications_enabled;
        $setting->save();

        return redirect()->back()->with('message', 'Pupillage application status updated.');
    }

}
