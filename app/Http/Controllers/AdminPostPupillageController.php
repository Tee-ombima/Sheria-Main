<?php

// app/Http/Controllers/AdminPostPupillageController.php

namespace App\Http\Controllers;
use App\Models\ApplicationSetting;
use Illuminate\Support\Facades\Auth;
use App\Models\PostPupillageSetting;

use App\Models\PostPupillage;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Exports\PostPupillageExport;
use Maatwebsite\Excel\Facades\Excel;
class AdminPostPupillageController extends Controller
{
    /**
     * Display a listing of pending post pupillage applications.
     */
    public function index(Request $request)
    {
        $query = PostPupillage::with('user')
            ->where('status', 'Pending');

        

        $applications = $query->paginate(10);

        return view('admin.post_pupillages.index', compact('applications'));
    }

    

    /**
     * Display the specified application.
     */
    public function show($id)
    {
        $postpupillage = PostPupillage::with('user')->findOrFail($id);

        return view('admin.post_pupillages.show', compact('postpupillage'));
    }

    /**
     * Update the specified application.
     */
    public function update(Request $request, PostPupillage $application)
    {
        $request->validate([
            'status' => 'required|in:Pending,Accepted,Not_Successful,Removed',
        ]);

        $application->update([
            'status' => $request->status,
        ]);

        // Send email logic (if needed)

        return redirect()->route('postPupillages.index')->with('message', 'Application updated successfully.');
    }

    /**
     * Remove the specified application.
     */
    public function destroy(PostPupillage $application)
    {
        $application->delete();

        return back()->with('message', 'Application removed successfully!');
    }

    /**
     * Archive the specified application.
     */
    public function archive(PostPupillage $application)
    {
        $application->update(['status' => 'Archived']);

        return redirect()->back()->with('message', 'Application archived successfully.');
    }

    /**
     * Display archived applications.
     */
    public function archivedApplications()
    {
        $applications = PostPupillage::where('status', 'Archived')->paginate(10);

        return view('admin.post_pupillages.archived', compact('applications'));
    }

    /**
     * Unarchive the specified application.
     */
    public function unarchive(PostPupillage $application)
    {
        $application->update(['status' => 'Pending']);

        return redirect()->back()->with('message', 'Application unarchived successfully.');
    }

    /**
     * Display a listing of non-pending post pupillage applications.
     */
    public function nonPending()
    {
        $applications = PostPupillage::with('user')
            ->where('status', '!=', 'Pending')
            ->paginate(10);

        return view('admin.post_pupillages.nonPending', compact('applications'));
    }

    public function accepted()
{
    $applications = PostPupillage::where('status', 'Accepted')->paginate(15);
    return view('admin.post_pupillages.accepted', compact('applications'));
}

    public function notAccepted()
    {
        $applications = PostPupillage::where('status', 'Not_Successful')->paginate(10);

        return view('admin.post_pupillages.not_accepted', compact('applications'));
    }

    public function export()
    {
        return Excel::download(new PostPupillageExport, 'postpupillage.xlsx');
    }
    public function toggleApply()
    {
        // Only allow admins
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized Action');
        }

        $setting = ApplicationSetting::first();
        $setting->post_pupillage_applications_enabled = !$setting->post_pupillage_applications_enabled;
        $setting->save();

        return redirect()->back()->with('message', 'Post Pupillage application status updated.');
    }

    public function editVacancyNumber()
    {
        // Only allow admins
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized Action');
        }
    
        $setting = PostPupillageSetting::first();
        return view('admin.post_pupillages.editVacancyNumber', compact('setting'));
    }
    
    public function updateVacancyNumber(Request $request)
    {
        // Only allow admins
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized Action');
        }
    
        $request->validate([
            'vacancy_no' => 'required|string|max:255',
        ]);
    
        $setting = PostPupillageSetting::first();
        if (!$setting) {
            $setting = new PostPupillageSetting();
        }
    
        $setting->vacancy_no = $request->input('vacancy_no');
        $setting->save();
    
        return redirect()->route('admin.postPupillages.editVacancyNumber')->with('message', 'Vacancy number updated successfully.');
    }
    

}
