<?php

// app/Http/Controllers/AdminPostPupillageController.php

namespace App\Http\Controllers;
use App\Models\ApplicationSetting;
use Illuminate\Support\Facades\Auth;
use App\Models\PostPupillageSetting;
use App\Models\PostPupillageApplicationSetting;
use Illuminate\Support\Facades\Cache;

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
        ->when($request->search_email, function($q) use ($request) {
            $q->where('email_address', 'like', '%'.$request->search_email.'%');
        })
        ->when($request->status_filter, function($q) use ($request) {
            $q->where('status', $request->status_filter);
        });

    // Optimized count with caching
    $showTotalPostPupillage = !$request->hasAny(['search_email', 'status_filter']);
    $totalPostPupillage = $showTotalPostPupillage ? Cache::remember('postpupillage_count', now()->addHours(6), function() {
        return PostPupillage::count();
    }) : null;

    return view('admin.post_pupillages.index', [
        'applications' => $query->paginate(10),
        'showTotalPostPupillage' => $showTotalPostPupillage, // Changed key name
    'totalPostPupillage' => $totalPostPupillage
    ]);
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
    if (Auth::user()->role !== 'superadmin') {
        abort(403, 'Unauthorized Action');
    }
    if ($application->status === 'Pending') {
        return back()->with('error', 'Cannot delete pending applications');
    }

    // Mark as deleted by admin and soft delete
    $application->update(['deleted_by_admin' => true]);
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
        if (Auth::user()->role !== 'admin' && Auth::user()->role !== 'superadmin') {
            abort(403, 'Unauthorized Action');
        }

        $setting = ApplicationSetting::first();
        $setting->post_pupillage_applications_enabled = !$setting->post_pupillage_applications_enabled;
        $setting->save();
        activity()
    ->causedBy(auth()->user())
    ->performedOn($setting)
    ->withProperties([
        'admin_email' => auth()->user()->email,
        'new_status' => $setting->post_pupillage_applications_enabled
    ])
    ->log('Application toggle status changed');

        return redirect()->back()->with('message', 'Post Pupillage application status updated.');
    }

    public function editVacancyNumber()
    {
        // Only allow admins
        if (Auth::user()->role !== 'admin' && Auth::user()->role !== 'superadmin') {
            abort(403, 'Unauthorized Action');
        }
    
        $setting = PostPupillageSetting::first();
        activity()
    ->causedBy(auth()->user())
    ->performedOn($setting)
    ->withProperties([
        'admin_email' => auth()->user()->email,
        'old_value' => $setting->vacancy_no,
        'new_value' => $setting->vacancy_no
    ])
    ->log('Vacancy number updated');
        return view('admin.post_pupillages.editVacancyNumber', compact('setting'));
    }
    
    public function updateVacancyNumber(Request $request)
    {
        // Only allow admins
        if (Auth::user()->role !== 'admin' && Auth::user()->role !== 'superadmin') {
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
    
    public function editSettings()
    {
        $settings = PostPupillageApplicationSetting::first();
        
        return view('admin.settings.post_pupillages.editpostpupillage', compact('settings'));
    }
    
    public function updateSettings(Request $request)
    {
        $validated = $request->validate([
            'max_postpupillage_applications' => 'required|integer|min:1',
        ]);
    
        $settings = PostPupillageApplicationSetting::first();
        $oldValue = $settings->max_postpupillage_applications;
        $settings->update($validated);
        activity()
    ->causedBy(auth()->user())
    ->performedOn($settings)
    ->withProperties([
        'admin_email' => auth()->user()->email,
        'old_value' => $oldValue,
        'new_value' => $validated['max_postpupillage_applications']
    ])
    ->log('Application settings updated');
    
        return redirect()->route('admin.postpupillage.edit')
            ->with('message', "Capacity updated from {$oldValue} to {$settings->max_postpupillage_applications} successfully!");
    }
    
// PostPupillageController.php

public function bulkUpdate(Request $request)
{
    $validated = $request->validate([
        'emails' => 'required|string',
        'status' => 'required|in:Pending,Accepted,Not_Successful,Removed'
    ]);

    $emails = array_unique(array_filter(array_map('trim', explode(',', $validated['emails']))));

    $updated = PostPupillage::whereIn('email_address', $emails)
        ->update(['status' => $validated['status']]);
        activity()
        ->causedBy(auth()->user())
        ->withProperties([
            'admin_email' => auth()->user()->email,
            'affected_emails' => $emails,
            'new_status' => $validated['status'],
            'count' => $updated
        ])
        ->log("Bulk updated $updated applications");
    return back()->with('message', "Successfully updated $updated applications");
}

public function bulkDestroy(Request $request)
{
    $validated = $request->validate([
        'emails' => 'required|string'
    ]);

    $emails = array_unique(array_filter(array_map('trim', explode(',', $validated['emails']))));

    // Retrieve the applications as a collection
    $applications = PostPupillage::whereIn('email_address', $emails)
        ->where('status', '!=', 'Pending')
        ->get();

    $deletedCount = $applications->count();

    // Loop through each application to mark and delete it
    $applications->each(function ($application) {
        $application->update(['deleted_by_admin' => true]);
        $application->delete();
    });
    activity()
    ->causedBy(auth()->user())
    ->withProperties([
        'admin_email' => auth()->user()->email,
        'affected_emails' => $emails,
        'count' => $deletedCount
    ])
    ->log("Bulk deleted $deletedCount applications");

    return back()->with('message', "Successfully deleted $deletedCount applications");
}


}
