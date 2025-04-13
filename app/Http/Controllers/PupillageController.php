<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pupillage;
use App\Models\SubCountyp;
use App\Models\Countyp;
use App\Models\KSCEGrade;
use App\Models\Institution;
use App\Models\InstitutionGrade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\ApplicationSetting;
use App\Models\PupillageApplicationSetting;
use Illuminate\Support\Facades\DB; // Add this import

class PupillageController extends Controller
{
    public function create()
    {
        $settings = PupillageApplicationSetting::first();
    $currentPending = Pupillage::where('status', 'Pending')->count();

    if ($currentPending >= $settings->max_pupillage_applications) {
        return redirect()->route('internships.index')
            ->with('message', 'Pupillage program is currently full');
    }
        $existingApplication = Pupillage::withTrashed()
        ->where('user_id', Auth::id())
        ->exists();

        if ($existingApplication) {
            return redirect()->route('internships.index')->with('message', 'You have already applied for pupillage.');
        }
        if (!$this->pupillageApplicationsEnabled()) {
            return redirect()->back()->with('message', 'No Pupillage program available at this time.');
        }

        $countyps = Countyp::orderByRaw("name = 'other' DESC, name ASC")->get();
        $ksceGrades = KSCEGrade::all();
        $institutions = Institution::orderByRaw("name = 'other' DESC, name ASC")->get();
        $institutionGrades = InstitutionGrade::all();

        return view('pupillages.create', compact('countyps', 'ksceGrades', 'institutions', 'institutionGrades'));
    }


    // Store the Pupillage application
    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {

        $settings = PupillageApplicationSetting::lockForUpdate()->first();
    $currentPending = Pupillage::where('status', 'Pending')->count();

    if ($currentPending >= $settings->max_pupillage_applications) {
        return redirect()->route('pupillages.index')
            ->with('error', 'Pupillage submissions are now closed');
    }
        $existingApplication = Pupillage::where('user_id', Auth::id())->first();

        if ($existingApplication) {
            return redirect()->route('internships.index')->with('message', 'You have already applied for pupillage.');
        }
        if (!$this->pupillageApplicationsEnabled()) {
            return redirect()->back()->with('message', 'No Pupillage program available at this time.');
        }

        // Validate the request
        $request->validate([
            // Personal Details
            'full_name' => 'required|string|max:50',
            'date_of_birth' => 'required|date',
            'identity_card_number' => 'required|integer',
            'gender' => 'required|in:Male,Female',
            'nationality' => 'required|string|max:50',
            'ethnicity' => 'required|string|max:50',
            'home_county' => 'required|string|max:50',
            'other_home_county' => 'required_if:home_county,Other|max:50',

            'sub_county' => 'required|string|max:50',
            'other_sub_county' => 'required_if:sub_county,Other|max:50',

            'disability_status' => 'required|boolean',
            'nature_of_disability' => 'nullable|string|max:50',

            // Contact Details
            'postal_address' => 'required|string|max:50',
            'postal_code' => 'required|string',
            'town' => 'required|string|max:255',
            'physical_address' => 'required|string|max:50',
            'mobile_number' => 'required|string',
            'alternate_mobile_number' => 'nullable|string',
            'email_address' => 'required|email|max:50',

            // Academic Qualification
            'ksce_grade' => 'required|string|max:50',
            'other_ksce_grade' => 'required_if:ksce_grade,Other|max:50',

            'institution_name' => 'required|string|max:50',
            'other_institution_name' => 'required_if:institution_name,Other|max:50',

            'institution_grade' => 'required|string|max:50',
            'other_institution_grade' => 'required_if:institution_grade,Other|max:50',

            'are_you_employed' => 'required|in:Yes,No',
            'employer_institution_name' => 'nullable|required_if:are_you_employed,Yes|string|max:255',
            'gross_salary' => 'nullable|required_if:are_you_employed,Yes|integer|min:0',
            'declaration' => 'required|accepted',

        ]);
        $homeCounty = $request->home_county == 'Other' ? $request->other_home_county : Countyp::find($request->home_county)->name;

        // Determine the sub county value
        $subCounty = $request->sub_county == 'Other' ? $request->other_sub_county : SubCountyp::find($request->sub_county)->name;
        // Determine the KSCE grade value
        $ksceGrade = $request->ksce_grade == 'Other' ? $request->other_ksce_grade : KSCEGrade::find($request->ksce_grade)->grade;

        // Determine the institution name
        $institutionName = $request->institution_name == 'Other' ? $request->other_institution_name : Institution::find($request->institution_name)->name;

        // Determine the institution grade
        $institutionGrade = $request->institution_grade == 'Other' ? $request->other_institution_grade : InstitutionGrade::find($request->institution_grade)->grade;
        if ($request->ksce_grade == 'Other') {
            $ksceGradeId = null;
            $otherKsceGrade = $request->other_ksce_grade;
        } else {
            $ksceGradeId = $request->ksce_grade;
            $otherKsceGrade = null;
        }
        // Determine the Institution Name value
        if ($request->institution_name == 'Other') {
            $institutionNameId = null;
            $otherInstitutionName = $request->other_institution_name;
        } else {
            $institutionNameId = $request->institution_name;
            $otherInstitutionName = null;
        }

        // Determine the Institution Grade value
        if ($request->institution_grade == 'Other') {
            $institutionGradeId = null;
            $otherInstitutionGrade = $request->other_institution_grade;
        } else {
            $institutionGradeId = $request->institution_grade;
            $otherInstitutionGrade = null;
        }
        // Create the Pupillage application
        Pupillage::create([
            'user_id' => Auth::id(),

            // Personal Details
            'full_name' => $request->full_name,
            'date_of_birth' => $request->date_of_birth,
            'identity_card_number' => $request->identity_card_number,
            'gender' => $request->gender,
            'nationality' => $request->nationality,
            'ethnicity' => $request->ethnicity,
            'home_county' => $homeCounty,
            'sub_county' => $subCounty,

            'disability_status' => $request->disability_status,
            'nature_of_disability' => $request->nature_of_disability,

            // Contact Details
            'postal_address' => $request->postal_address,
            'postal_code' => $request->postal_code,
            'town' => $request->town,
            'physical_address' => $request->physical_address,
            'mobile_number' => $request->mobile_number,
            'alternate_mobile_number' => $request->alternate_mobile_number,
            'email_address' => $request->email_address,
            // Academic Qualification
            'ksce_grade' => $ksceGrade,
            'institution_name' => $institutionName,
            'institution_grade' => $institutionGrade,

            'other_ksce_grade' => $otherKsceGrade,
            'other_institution_name' => $otherInstitutionName,
            'other_institution_grade' => $otherInstitutionGrade,

            'are_you_employed' => $request->are_you_employed,
            'employer_institution_name' => $request->employer_institution_name,
            'gross_salary' => $request->gross_salary,
            'declaration' => $request->has(key: 'declaration'), // Convert checkbox to boolean

            'status' => 'Pending',
        ]);
    });
        return redirect()->route('internships.index')->with('message', 'Pupillage application submitted successfully.');
    }


    public function getSubCounties($county_id)
    {
        if ($county_id == 'Other') {
            return response()->json([]);
        }

        $subCountyps = SubCountyp::where('county_id', $county_id)->pluck('name', 'id');

        return response()->json($subCountyps);
    }
    private function pupillageApplicationsEnabled()
{
    $applicationSetting = ApplicationSetting::first();
    return $applicationSetting && $applicationSetting->pupillage_applications_enabled;
}

}
