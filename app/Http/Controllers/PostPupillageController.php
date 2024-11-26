<?php

namespace App\Http\Controllers;

use App\Models\PostPupillageSetting;
use App\Models\ApplicationSetting;

use Illuminate\Http\Request;
use App\Models\PostPupillage;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use App\Models\SubCountypp;
use App\Models\Countypp;

class PostPupillageController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::check() && Auth::user()->role === 'admin') {
                return $next($request);
            }
            abort(403, 'Unauthorized Action');
        })->only(['editVacancyNumber', 'updateVacancyNumber']);
    }
    public function create()
    {
        $existingApplication = PostPupillage::where('user_id', Auth::id())->first();
        if ($existingApplication) {
            return redirect()->route('internships.index')->with('message', 'You have already applied for the Post Pupillage program.');
        }
        // Check if applications are enabled
        if (!$this->postPupillageApplicationsEnabled()) {
            return redirect()->back()->with('message', 'No Post Pupillage program available at this time.');
        }

        // Fetch the vacancy number from the settings
        $setting = PostPupillageSetting::first();
        $vacancyNo = $setting ? $setting->vacancy_no : null;

        // Fetch the counties
        $countypps = Countypp::all();

        return view('post_pupillages.create', compact('countypps', 'vacancyNo'));
    }


    /**
     * Store a newly created Post Pupillage application in storage.
     */
    // Store the Post Pupillage application
    public function store(Request $request)
    {
        // Check if the user has already applied
        $existingApplication = PostPupillage::where('user_id', Auth::id())->first();

        if ($existingApplication) {
            return redirect()->route('internships.index')->with('message', 'You have already applied for the Post Pupillage program.');
        }
        if (!$this->postPupillageApplicationsEnabled()) {
            return redirect()->back()->with('message', 'No Post Pupillage program available at this time.');
        }

        // Validate the request
        $request->validate([
            'full_name' => 'required|string|max:50',
            'date_of_birth' => 'required|date',
            'identity_card_number' => 'required|integer',
            'gender' => 'required|string',
            'kra_pin' => 'required|string|max:50',
            'nhif_card_number' => 'required|string|max:50',
            'postal_address' => 'required|string|max:50',
            'postal_code' => 'required|string',
            'town' => 'required|string|max:50',
            'email_address' => 'required|email|max:50',
            'mobile_number' => 'required|integer|max:20',
            'home_county' => 'required|string|max:50',
            'other_home_county' => 'required_if:home_county,Other|max:50',

            'sub_county' => 'required|string|max:50',
            'other_sub_county' => 'required_if:sub_county,Other|max:50',
            'ethnicity' => 'required|string|max:50',
            'disability_status' => 'required|boolean',
            'nature_of_disability' => 'nullable|string|max:50',
            'deployment_region' => 'required|string|max:50',
            'declaration' => 'accepted',
        ]);
        $homeCounty = $request->home_county == 'Other' ? $request->other_home_county : Countypp::find($request->home_county)->name;

        // Determine the sub county value
        $subCounty = $request->sub_county == 'Other' ? $request->other_sub_county : SubCountypp::find($request->sub_county)->name;
        // Fetch the vacancy number from the settings
        $setting = PostPupillageSetting::first();
        $vacancyNo = $setting ? $setting->vacancy_no : null;

        // Create the Post Pupillage application
        PostPupillage::create([
            'user_id' => Auth::id(),
            'vacancy_no' => $vacancyNo,
            'full_name' => $request->full_name,
            'date_of_birth' => $request->date_of_birth,
            'identity_card_number' => $request->identity_card_number,
            'gender' => $request->gender,
            'kra_pin' => $request->kra_pin,
            'nhif_card_number' => $request->nhif_card_number,
            'postal_address' => $request->postal_address,
            'postal_code' => $request->postal_code,
            'town' => $request->town,
            'email_address' => $request->email_address,
            'mobile_number' => $request->mobile_number,
            'home_county' => $homeCounty,
            'sub_county' => $subCounty,
            'ethnicity' => $request->ethnicity,
            'disability_status' => $request->disability_status,
            'nature_of_disability' => $request->nature_of_disability,
            'deployment_region' => $request->deployment_region,
            'declaration' => $request->declaration,
        ]);

        return redirect()->route('internships.index')->with('message', 'Post Pupillage application submitted successfully.');
    }



    /**
     * Display a listing of the user's Post Pupillage applications.
     */

    /**
     * Show the form for editing the specified Post Pupillage application.
     */
    public function edit($id)
    {
        $postpupillage = PostPupillage::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $countypps = Countypp::all();
        // Fetch the vacancy number from the settings
        $setting = PostPupillageSetting::first();
        $vacancyNo = $setting ? $setting->vacancy_no : null;
        return view('post_pupillages.edit', compact('postpupillage', 'countypps', 'vacancyNo'));
    }

    /**
     * Update the specified Post Pupillage application in storage.
     */
    // Update the specified Post Pupillage application in storage
    public function update(Request $request, $id)
    {
        // Find the Post Pupillage application belonging to the authenticated user
        $postpupillage = PostPupillage::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        // Validate the request
        $request->validate([
            'full_name' => 'required|string|max:50',
            'date_of_birth' => 'required|date',
            'identity_card_number' => 'required|integer',
            'gender' => 'required|string',
            'kra_pin' => 'required|string|max:50',
            'nhif_card_number' => 'required|string|max:50',
            'postal_address' => 'required|string|max:50',
            'postal_code' => 'required|string',
            'town' => 'required|string|max:50',
            'email_address' => 'required|email|max:50',
            'mobile_number' => 'required|integer|max:20',
            'home_county' => 'required|string|max:50',
            'other_home_county' => 'required_if:home_county,Other|max:50',

            'sub_county' => 'required|string|max:50',
            'other_sub_county' => 'required_if:sub_county,Other|max:50',
            'ethnicity' => 'required|string|max:50',
            'disability_status' => 'required|boolean',
            'nature_of_disability' => 'nullable|string|max:50',
            'deployment_region' => 'required|string|max:50',
            'declaration' => 'accepted',
        ]);
        $homeCounty = $request->home_county == 'Other' ? $request->other_home_county : Countypp::find($request->home_county)->name;

        // Determine the sub county value
        $subCounty = $request->sub_county == 'Other' ? $request->other_sub_county : SubCountypp::find($request->sub_county)->name;
        $setting = PostPupillageSetting::first();
        $vacancyNo = $setting ? $setting->vacancy_no : null;
        // Update the Post Pupillage application
        $postpupillage->update([
            'vacancy_no' => $vacancyNo,
            'full_name' => $request->full_name,
            'date_of_birth' => $request->date_of_birth,
            'identity_card_number' => $request->identity_card_number,
            'gender' => $request->gender,
            'kra_pin' => $request->kra_pin,
            'nhif_card_number' => $request->nhif_card_number,
            'postal_address' => $request->postal_address,
            'postal_code' => $request->postal_code,
            'town' => $request->town,
            'email_address' => $request->email_address,
            'mobile_number' => $request->mobile_number,
            'home_county' => $homeCounty,
            'sub_county' => $subCounty,
            'ethnicity' => $request->ethnicity,
            'disability_status' => $request->disability_status,
            'nature_of_disability' => $request->nature_of_disability,
            'deployment_region' => $request->deployment_region,
            'declaration' => $request->declaration,
        ]);

        return redirect()->route('internships.index')->with('message', 'Post Pupillage application updated successfully.');
    }


    /**
     * Remove the specified Post Pupillage application from storage.
     */
    public function destroy($id)
    {
        $postpupillages = PostPupillage::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $postpupillages->delete();

        return redirect()->route('internships.index')->with('message', 'Post Pupillage application deleted successfully.');
    }

    public function getSubCounties($county_id)
    {
        if ($county_id == 'Other') {
            return response()->json([]);
        }

        $subCountypps = SubCountypp::where('county_id', $county_id)->pluck('name', 'id');

        return response()->json($subCountypps);
    }

    private function postPupillageApplicationsEnabled()
{
    $applicationSetting = ApplicationSetting::first();
    return $applicationSetting && $applicationSetting->post_pupillage_applications_enabled;
}

}
