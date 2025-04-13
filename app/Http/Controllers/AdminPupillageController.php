<?php

// app/Http/Controllers/AdminPupillageController.php

namespace App\Http\Controllers;
use App\Models\ApplicationSetting;
use Illuminate\Support\Facades\Auth;
use App\Models\PupillageApplicationSetting;
use Illuminate\Support\Facades\DB; // Add this import
use Illuminate\Support\Facades\Cache;
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
            ->when($request->search_email, function($q) use ($request) {
                $q->where('email_address', 'like', '%'.$request->search_email.'%');
            })
            ->when($request->status_filter, function($q) use ($request) {
                $q->where('status', $request->status_filter);
            });

        // Optimized count with caching
        $showTotalPupillage = !$request->hasAny(keys: ['search_email', 'status_filter']);
        $totalPupillage = $showTotalPupillage ? Cache::remember('pupillage_count', now()->addHours(6), function() {
            return Pupillage::count();
        }) : null;

        return view('admin.pupillages.index', [
            'applications' => $query->paginate(10),
            'showTotalPupillage' => $showTotalPupillage, // Changed key name
    'totalPupillage' => $totalPupillage
        ]);
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
            'applicant_email' => $application->email,
            'status' => $application->status
        ])
        ->log('Application deleted');
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
        if (Auth::user()->role !== 'admin' && Auth::user()->role !== 'superadmin') {
            abort(403, 'Unauthorized Action');
        }

        $setting = ApplicationSetting::first();
        $setting->pupillage_applications_enabled = !$setting->pupillage_applications_enabled;
        $setting->save();
        activity()
    ->causedBy(auth()->user())
    ->performedOn($setting)
    ->withProperties([
        'admin_email' => auth()->user()->email,
        'new_status' => $setting->pupillage_applications_enabled
    ])
    ->log('Application toggle status changed');

        return redirect()->back()->with('message', 'Pupillage application status updated.');
    }

    public function editSettings()
    {
        $settings = PupillageApplicationSetting::first();
        
        return view('admin.settings.pupillage.editpupillage', compact('settings'));
    }
    
    public function updateSettings(Request $request)
    {
        $validated = $request->validate([
            'max_pupillage_applications' => 'required|integer|min:1',
        ]);
    
        $settings = PupillageApplicationSetting::first();
        $oldValue = $settings->max_pupillage_applications;
        $settings->update($validated);
        activity()
    ->causedBy(auth()->user())
    ->performedOn($settings)
    ->withProperties([
        'admin_email' => auth()->user()->email,
        'old_value' => $oldValue,
        'new_value' => $validated['max_pupillage_applications']
    ])
    ->log('Application settings updated');
    
        return redirect()->route('admin.pupillage.edit')
            ->with('message', "Capacity updated from {$oldValue} to {$settings->max_pupillage_applications} successfully!");
    }
    public function refreshCount($program)
{
    $programs = [
        
        'pupillage' => [
            'model' => Pupillage::class,
            'cache' => 'pupillage_count',
            'label' => 'Pupillages'
        ]
    ];

   

    $config = $programs[$program];
    $count = $config['model']::count();
    
    Cache::put($config['cache'], $count, now()->addHours(6));

    return response()->json([
        'count' => number_format($count),
        'label' => $config['label']
    ]);
}
// In PupillageController.php

public function bulkUpdate(Request $request)
{
    $validated = $request->validate([
        'emails' => 'required|string',
        'status' => 'required|in:Pending,Accepted,Not_Successful'
    ]);

    $emails = array_unique(array_filter(array_map('trim', explode(',', $validated['emails']))));

    $updated = Pupillage::whereIn('email_address', $emails)
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
    return back()->with('message', "Updated $updated applications");
}
public function bulkDestroy(Request $request)
{
    if (Auth::user()->role !== 'superadmin') {
        abort(403, 'Unauthorized Action');
    }
    $validated = $request->validate([
        'emails' => 'required|string'
    ]);

    $emails = array_unique(array_filter(array_map('trim', explode(',', $validated['emails']))));

    // Retrieve the collection of applications to delete
    $applications = Pupillage::whereIn('email_address', $emails)
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

    return back()->with('message', "Deleted " . $deletedCount . " applications");
}

}
