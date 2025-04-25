<?php

namespace App\Http\Controllers;

use App\Models\Prof_area_of_specialisation;
use App\Models\Prof_area_of_study_high_school_level;
use App\Models\Prof_award;
use App\Models\Prof_grade;
use App\Models\Specialisation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

use App\Models\Subcounty;
use App\Models\Salutation; // Add this line
use App\Models\Ethnicity; // Add this line
use App\Models\Homecounty; // Add this line
use App\Models\Award; // Add this line
use App\Models\Highschool; // Add this line
use App\Models\Grade; // Add this line
use App\Models\Course; // Add this line
use App\Models\PersonalInfo;
use App\Models\AcademicInfo;
use App\Models\ProfInfo;
use App\Models\RelevantCourses;
use App\Models\Constituency;
use App\Models\FormSubmission;
use App\Models\CountryCode;
use Spatie\Activitylog\Models\Activity;


use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    



    public function showPersonalInfo(Request $request)
    {
        $userId = $request->user()->id; // Authenticated user's ID
        $personalInfoSubmitted = PersonalInfo::where('user_id', $userId)->exists();
        
        // Retrieve session data (using [] as the default value)
        $inputData = $request->session()->get('inputData', []);
    
        // Retrieve and sort options, ensuring "other" appears last
        $salutations = Salutation::orderByRaw("name = 'other' DESC, name ASC")->get();
        $ethnicities = Ethnicity::orderByRaw("name = 'other' DESC, name ASC")->get();
        $homecounties = Homecounty::where(function ($query) use ($userId) {
            $query->where('added_by_user', false)
                  ->orWhere('user_id', $userId);
        })
        ->orderByRaw("name ASC")
        ->get();
        $subcounties = Subcounty::where(function ($query) use ($userId) {
            $query->where('added_by_user', false)
                  ->orWhere('user_id', $userId);
        })
        ->orderByRaw("name ASC")
        ->get();
        $constituencies = Constituency::where(function ($query) use ($userId) {
            $query->where('added_by_user', false)
                  ->orWhere('user_id', $userId);
        })
        ->orderByRaw("name ASC")
        ->get();
        
        
        
        
        
        $countryCodes = CountryCode::orderByRaw("CASE WHEN code = '+254' THEN 0 ELSE 1 END, name ASC")->get();
    
        return view('users.profile.personal-info', [
            'inputData'              => $inputData,
            'personalInfoSubmitted'  => $personalInfoSubmitted,
            'salutations'            => $salutations,
            'ethnicities'            => $ethnicities,
            'homecounties'           => $homecounties,
            'countryCodes'           => $countryCodes,
            'subcounties' =>$subcounties,
            'constituencies'=>$constituencies,
        ]);
    }

    public function savePersonalInfo(Request $request)
    {
        // Validate incoming data with custom error messages for required_if rules
        $validatedData = $request->validate([
            // Personal Information
            'surname'      => 'required|string|max:50',
            'firstname'    => 'required|string|max:50',
            'lastname'     => 'nullable|string|max:50',
            'dob'          => 'required|date',
            'idno'         => 'required|digits:8',
            'kra_pin'      => 'required|string|max:11',
            'nationality'  => 'required|string|max:50',

            // Salutation
            'salutation'         => 'required|string|max:50',
            'salutation_other'   => 'nullable|string|max:50',

            // Ethnicity
            'ethnicity'         => 'required|string|max:50',
            'ethnicity_other'   => 'nullable|string|max:50',

            'homecounty_id' => 'required|exists:homecounties,id',
    'subcounty_id' => 'required|exists:subcounties,id',
    'constituency_id' => 'required|exists:constituencies,id',

            'postal_address'             => 'required|string',
            'code'                       => 'required|numeric',
            'town_city'                  => 'required|string|max:50',
            'telephone_num' => 'required|digits:9',
            'telephone_country_code'     => 'required|string|max:50',
            'mobile_num' => 'required|digits:9',
            'mobile_country_code'        => 'required|string|max:50',
            'email_address'              => 'required|email|max:100',
            'alt_contact_person'         => 'required|string|max:100',
            'alt_contact_telephone_num' => 'required|digits:9',
            'alt_contact_country_code'   => 'required|string|max:50',

            'disability_question'        => 'nullable|string',
            'nature_of_disability'       => 'nullable|string|max:100',
            'ncpd_registration_no'       => 'nullable|string|max:100',

            // Employment Information
            'ministry'                   => 'nullable|string|max:100',
            'station'                    => 'nullable|string|max:100',
            'personal_employment_number' => 'nullable|string|max:100',
            'present_substantive_post'   => 'nullable|string|max:100',
            'job_grp_scale_grade'        => 'nullable|string|max:100',
            'date_of_current_appointment'=> 'nullable|date',
            'upgraded_post'              => 'nullable|string|max:100',
            'effective_date_previous_appointment' => 'nullable|date',
            'on_secondment_organization' => 'nullable|string|max:100',
            'designation'                => 'nullable|string|max:100',
            'job_group'                  => 'nullable|string|max:100',
            'terms_of_service'           => 'nullable|string',
        ], [
            
        ]);

        $user_id = Auth::id();
        $data = $validatedData; // Initialize $data with validated data

        // Handle Salutation – use "other" value if applicable
        if (strtolower($request->salutation) === 'other') {
            $data['salutation'] = $request->salutation_other;
        }

        // Handle Ethnicity – use "other" value if applicable
        if (strtolower($request->ethnicity) === 'other') {
            $data['ethnicity'] = $request->ethnicity_other;
        }
        $homecounty = Homecounty::findOrFail($request->homecounty_id);

        // Subcounty handling (simple ID-based)
        $subcounty = Subcounty::findOrFail($request->subcounty_id);
        
        // Constituency handling (simple ID-based)
        $constituency = Constituency::findOrFail($request->constituency_id);
        // Update the IDs in the data array to reference the proper records
        $data['homecounty_id'] = $homecounty->id;
        $data['constituency_id'] = $constituency->id;
        $data['subcounty_id'] = $subcounty->id;
        $data['user_id'] = $user_id;

        // Remove temporary "other" fields before saving
        unset(
            $data['salutation_other'],
            $data['ethnicity_other'],
        );

        // Save (or update) the personal info for this user
        PersonalInfo::updateOrCreate(
            ['user_id' => $user_id],
            $data
        );
        $personalInfo = PersonalInfo::updateOrCreate(
            ['user_id' => auth()->id()],  // Condition to find the record
            $data                          // Data to be updated/created
        );

        // Optionally, save the data to the session
        $request->session()->put('inputData', $data);
        $action = $personalInfo->wasRecentlyCreated ? 'created' : 'updated';
$logMessage = "Personal information $action";

activity()
    ->causedBy(auth()->user())
    ->performedOn($personalInfo)
    ->withProperties([
        'user_email' => auth()->user()->email,
        'changes' => $personalInfo->getChanges(),
        'key_fields' => [
            'name' => $personalInfo->fullname,
            'id_number' => $personalInfo->idno,
            'location' => $personalInfo->constituency->name
        ]
    ])
    ->log($logMessage);
       
        
            return view('confirmation', [
                'message'  => 'Profile Information submitted successfully!',
                'next_url' => route('profile.academic-info') // Adjust the route as needed.
            ]);
    }




public function showAcademicInfo(Request $request)
{
    if (Auth::user()->role !== 'user') {
        abort(403, 'Limited Action');
    }
    $userId = $request->user()->id; // Assuming the user ID is available via authenticated user
    $academicInfoSubmitted = AcademicInfo::where('user_id', $userId)->exists();
    
    // Retrieve stored data from the database
    $academicInfo = AcademicInfo::where('user_id', Auth::id())->paginate(10); // Adjust the number per page as needed

    $awards = Award::orderByRaw("name = 'other' DESC, name ASC")->get();

    $grades = Grade::orderByRaw("name = 'other' DESC, name ASC")->get();
    $courses = Course::orderByRaw("name = 'other' DESC, name ASC")->get();
    $specialisations = Specialisation::orderByRaw("name = 'other' DESC, name ASC")->get();

    $highschools = Highschool::orderByRaw("name = 'other' DESC, name ASC")->get();
    

    return view('users.profile.academic-info', [
        'academicInfo' => $academicInfo,
        'academicInfoSubmitted'=>$academicInfoSubmitted,
        'awards' => $awards,
        'grades' => $grades,
        'courses'=> $courses,
        'specialisations'=>$specialisations,
        'highschools' => $highschools,
        
    ]);
}
public function addRow(Request $request)
{
    
    // Define validation rules
    $rules = [
        'institution_name' => 'required|string|max:50',
        'student_admission_no' => 'nullable|string|max:50',

        'highschool' => 'required|string|max:50',
        'highschool_other' => 'nullable|string|max:50',

        'specialisation' => 'required|string|max:50',
        'specialisation_other' => 'nullable|string|max:50',

        'course' => 'required|string|max:50',
        'course_other' => 'nullable|string|max:50',

        'award' => 'required|string|max:50',
        'award_other' => 'nullable|string|max:50',

        'grade' => 'required|string|max:50',
        'grade_other' => 'nullable|string|max:50',

        'certificate_no' => 'required|string|max:50',
        'start_date' => 'nullable|date',
        'end_date' => 'nullable|date',
        'graduation_completion_date' => 'nullable|date',
    ];

    $messages = [
        'highschool_other.required_if' => 'Please specify your Area of Study.',
        'specialisation_other.required_if' => 'Please specify your Specialisation.',
        'course_other.required_if' => 'Please specify your Course.',
        'award_other.required_if' => 'Please specify your Award.',
        'grade_other.required_if' => 'Please specify your Grade.',
    ];

    // Validate the request data
    $validator = Validator::make($request->all(), $rules, $messages);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Prepare the row data
    $row = $request->only([
        'institution_name',
        'student_admission_no',
        'certificate_no',
        'start_date',
        'end_date',
        'graduation_completion_date',
        'highschool',
        'highschool_other',
        'specialisation',
        'specialisation_other',
        'course',
        'course_other',
        'award',
        'award_other',
        'grade',
        'grade_other',
    ]);

    // Handle 'Other' fields
    if ($request->highschool === 'other') {
        $row['highschool'] = $request->highschool_other;
    }

    if ($request->specialisation === 'other') {
        $row['specialisation'] = $request->specialisation_other;
    }

    if ($request->course === 'other') {
        $row['course'] = $request->course_other;
    }

    if ($request->award === 'other') {
        $row['award'] = $request->award_other;
    }

    if ($request->grade === 'other') {
        $row['grade'] = $request->grade_other;
    }

    // Remove 'other' fields
    unset($row['highschool_other']);
    unset($row['specialisation_other']);
    unset($row['course_other']);
    unset($row['award_other']);
    unset($row['grade_other']);

    // Save each row to the session temporarily
    $rows = session()->get('rows', []);
    $rows[] = $row;
    session()->put('rows', $rows);


    return redirect()->back()->with('message','Row added successfully.Please Save before proceeding');
}

public function editAcademicInfo($id)
{
    // Ensure the user is authenticated and owns the data
    $academicInfo = AcademicInfo::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

    // Get options for select fields
    $awards = Award::orderByRaw("name = 'other' DESC, name ASC")->get();
    $grades = Grade::orderByRaw("name = 'other' DESC, name ASC")->get();
    $courses = Course::orderByRaw("name = 'other' DESC, name ASC")->get();
    $specialisations = Specialisation::orderByRaw("name = 'other' DESC, name ASC")->get();
    $highschools = Highschool::orderByRaw("name = 'other' DESC, name ASC")->get();

    return view('users.profile.edit-academic-info', [
        'academicInfo' => $academicInfo,
        'awards' => $awards,
        'grades' => $grades,
        'courses'=> $courses,
        'specialisations'=>$specialisations,
        'highschools' => $highschools,
    ]);
}

public function updateAcademicInfo(Request $request, $id)
{
    // Define validation rules
    $rules = [
        'institution_name' => 'required|string|max:50',
        'student_admission_no' => 'nullable|string|max:50',
        'highschool' => 'required|string|max:50',
        'specialisation' => 'required|string|max:50',
        'award' => 'required|string|max:50',
        'course' => 'required|string|max:50',
        'grade' => 'required|string|max:50',
        'certificate_no' => 'required|string|max:50',
        'start_date' => 'nullable|date',
        'end_date' => 'nullable|date',
        'graduation_completion_date' => 'nullable|date',
    ];

    // Validate the request data
    $validatedData = $request->validate($rules);

    // Ensure the user is authenticated and owns the data
    $academicInfo = AcademicInfo::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

    // Update the data
    $academicInfo->update($validatedData);

    // Redirect back with a success message

    return redirect()->route('profile.academic-info')->with('message','Academic information updated successfully.');
}



public function saveAcademicInfo(Request $request)
{
    $rows = session()->get('rows', []);
    $user_id = Auth::id();
    if (count($rows) > 5) {
        return redirect()->back()->with('message', 'You are not allowed to submit more than 5 academic records.');
    }
    
    if (empty($rows)) {
        return redirect()->back()->with('message','Please add at least one row of data before submitting');
    }

    // Define validation rules
    $rules = [
        'institution_name' => 'required|string|max:50',
        'student_admission_no' => 'nullable|string|max:50',

        'highschool' => 'required|string|max:50',
        'highschool_other' => 'nullable|string|max:50',

        'specialisation' => 'required|string|max:50',
        'specialisation_other' => 'nullable|string|max:50',

        'course' => 'required|string|max:50',
        'course_other' => 'nullable|string|max:50',

        'award' => 'required|string|max:50',
        'award_other' => 'nullable|string|max:50',

        'grade' => 'required|string|max:50',
        'grade_other' => 'nullable|string|max:100',

        'certificate_no' => 'required|string|max:50',
        'start_date' => 'nullable|date',
        'end_date' => 'nullable|date',
        'graduation_completion_date' => 'nullable|date',
    ];

    $messages = [
        'highschool_other.required_if' => 'Please specify your Area of Study.',
        'specialisation_other.required_if' => 'Please specify your Specialisation.',
        'course_other.required_if' => 'Please specify your Course.',
        'award_other.required_if' => 'Please specify your Award.',
        'grade_other.required_if' => 'Please specify your Grade.',
    ];

    // Validate each row
    foreach ($rows as $index => $row) {
        $validator = Validator::make($row, $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Handle 'Other' fields
        if ($row['highschool'] === 'other') {
            $row['highschool'] = $row['highschool_other'];
        }

        if ($row['specialisation'] === 'other') {
            $row['specialisation'] = $row['specialisation_other'];
        }

        if ($row['course'] === 'other') {
            $row['course'] = $row['course_other'];
        }

        if ($row['award'] === 'other') {
            $row['award'] = $row['award_other'];
        }

        if ($row['grade'] === 'other') {
            $row['grade'] = $row['grade_other'];
        }

        // Remove 'other' fields
        unset($row['highschool_other']);
        unset($row['specialisation_other']);
        unset($row['course_other']);
        unset($row['award_other']);
        unset($row['grade_other']);

        // Add user_id
        $row['user_id'] = $user_id;

        // Save to database
        AcademicInfo::create($row);
    }
    $createdCount = count($rows);
activity()
    ->causedBy(auth()->user())
    ->withProperties([
        'user_email' => auth()->user()->email,
        'entries_count' => $createdCount,
        'degrees' => array_column($rows, 'award')
    ])
    ->log("Submitted $createdCount academic records");

    // Clear the session
    session()->forget('rows');

    
    return view('confirmation', [
        'message'  => 'Academic Information submitted successfully!',
        'next_url' => route('profile.prof-info') // Adjust the route as needed.
    ]);
}

public function removeSessionRow(Request $request)
{
    $index = $request->input('index');
    $rows = session()->get('rows', []);
    if (isset($rows[$index])) {
        unset($rows[$index]);
        session()->put('rows', array_values($rows)); // Reindex the array
    }
    return redirect()->back()->with('message','Row removed successfully');
}

public function deleteAcademicInfo($id)
{
    $academicInfo = AcademicInfo::findOrFail($id);
    $academicInfo->delete();

    return redirect()->back()->with('message','Academic info deleted successfully');
}






public function showProfInfo(Request $request)
{
    if (Auth::user()->role !== 'user') {
        abort(403, 'Limited Action');
    }
    $userId = $request->user()->id; // Assuming the user ID is available via authenticated user
    $profInfoSubmitted = ProfInfo::where('user_id', $userId)->exists();
    
    // Retrieve stored data from the database
    $profInfo = ProfInfo::where('user_id', $userId)->paginate(10); // Get all records, not paginated

    $prof_awards = Prof_award::orderByRaw("name = 'other' DESC, name ASC")->get();
    $prof_grades = Prof_grade::orderByRaw("name = 'other' DESC, name ASC")->get();
    $prof_area_of_study_high_school_levels = Prof_area_of_study_high_school_level::orderByRaw("name = 'other' DESC, name ASC")->get();
    $prof_area_of_specialisations = Prof_area_of_specialisation::orderByRaw("name = 'other' DESC, name ASC")->get();
    

    return view('users.profile.prof-info', [
        'profInfo' => $profInfo,
        'profInfoSubmitted'=>$profInfoSubmitted,
        'prof_awards' => $prof_awards,
        'prof_grades' => $prof_grades,
        'prof_area_of_study_high_school_levels'=>$prof_area_of_study_high_school_levels,
        'prof_area_of_specialisations' => $prof_area_of_specialisations,

    ]);
}
public function addProfRow(Request $request)
{
    // Define validation rules
    $rules = [
        'prof_institution_name' => 'required|string|max:50',
        'prof_student_admission_no' => 'nullable|string|max:50',

        'prof_area_of_study_high_school_level' => 'required|string|max:50',
        'prof_area_of_study_high_school_level_other' => 'nullable|string|max:50',

        'prof_area_of_specialisation' => 'required|string|max:50',
        'prof_area_of_specialisation_other' => 'nullable|string|max:50',

        'prof_award' => 'required|string|max:50',
        'prof_award_other' => 'nullable|string|max:50',

        'prof_course' => 'nullable|string|max:50',

        'prof_grade' => 'required|string|max:50',
        'prof_grade_other' => 'nullable|string|max:50',

        'prof_certificate_no' => 'nullable|string|max:50',
        'prof_start_date' => 'required|date',
        'prof_end_date' => 'required|date',
    ];

    $messages = [
        'prof_area_of_study_high_school_level_other.required_if' => 'Please specify your Area of Study.',
        'prof_area_of_specialisation_other.required_if' => 'Please specify your Area of Specialisation.',
        'prof_award_other.required_if' => 'Please specify your Professional Award.',
        'prof_grade_other.required_if' => 'Please specify your Grade.',
    ];

    // Validate the request data
    $validator = Validator::make($request->all(), $rules, $messages);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Prepare the row data
    $row = $request->only([
        'prof_institution_name',
        'prof_student_admission_no',
        'prof_certificate_no',
        'prof_start_date',
        'prof_end_date',
        'prof_course',
        'prof_area_of_study_high_school_level',
        'prof_area_of_study_high_school_level_other',
        'prof_area_of_specialisation',
        'prof_area_of_specialisation_other',
        'prof_award',
        'prof_award_other',
        'prof_grade',
        'prof_grade_other',
    ]);

    // Handle 'Other' fields
    if ($request->prof_area_of_study_high_school_level === 'other') {
        $row['prof_area_of_study_high_school_level'] = $request->prof_area_of_study_high_school_level_other;
    }

    if ($request->prof_area_of_specialisation === 'other') {
        $row['prof_area_of_specialisation'] = $request->prof_area_of_specialisation_other;
    }

    if ($request->prof_award === 'other') {
        $row['prof_award'] = $request->prof_award_other;
    }

    if ($request->prof_grade === 'other') {
        $row['prof_grade'] = $request->prof_grade_other;
    }

    // Remove 'other' fields
    unset($row['prof_area_of_study_high_school_level_other']);
    unset($row['prof_area_of_specialisation_other']);
    unset($row['prof_award_other']);
    unset($row['prof_grade_other']);

    // Save each row to the session temporarily
    $rows = session()->get('rows', []);
    $rows[] = $row;
    session()->put('rows', $rows);


    return redirect()->back()->with('message','Row added successfully.Please Save before proceeding');
}

public function editProfInfo($id)
{
    // Ensure the user is authenticated and owns the data
    $profInfo = ProfInfo::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

    // Get options for select fields
    $prof_awards = Prof_award::orderByRaw("name = 'other' DESC, name ASC")->get();
    $prof_grades = Prof_grade::orderByRaw("name = 'other' DESC, name ASC")->get();
    $prof_area_of_study_high_school_levels = Prof_area_of_study_high_school_level::orderByRaw("name = 'other' DESC, name ASC")->get();
    $prof_area_of_specialisations = Prof_area_of_specialisation::orderByRaw("name = 'other' DESC, name ASC")->get();

    return view('users.profile.edit-prof-info', [
        'profInfo' => $profInfo,
        'prof_awards' => $prof_awards,
        'prof_grades' => $prof_grades,
        'prof_area_of_study_high_school_levels' => $prof_area_of_study_high_school_levels,
        'prof_area_of_specialisations' => $prof_area_of_specialisations,
    ]);
}

public function updateProfInfo(Request $request, $id)
{
    // Define validation rules
    $rules = [
        'prof_institution_name' => 'required|string|max:50',
        'prof_student_admission_no' => 'nullable|string|max:50',

        'prof_area_of_study_high_school_level' => 'required|string|max:50',
        'prof_area_of_study_high_school_level_other' => 'nullable|string|max:50',

        'prof_area_of_specialisation' => 'required|string|max:50',
        'prof_area_of_specialisation_other' => 'nullable|string|max:50',

        'prof_award' => 'required|string|max:50',
        'prof_award_other' => 'nullable|string|max:50',

        'prof_course' => 'nullable|string|max:50',

        'prof_grade' => 'required|string|max:50',
        'prof_grade_other' => 'nullable|string|max:50',

        'prof_certificate_no' => 'nullable|string|max:50',
        'prof_start_date' => 'required|date',
        'prof_end_date' => 'required|date',
    ];

    $messages = [
        'prof_area_of_study_high_school_level_other.required_if' => 'Please specify your Area of Study.',
        'prof_area_of_specialisation_other.required_if' => 'Please specify your Area of Specialisation.',
        'prof_award_other.required_if' => 'Please specify your Professional Award.',
        'prof_grade_other.required_if' => 'Please specify your Grade.',
    ];

    // Validate the request data
    $validatedData = $request->validate($rules, $messages);

    // Ensure the user is authenticated and owns the data
    $profInfo = ProfInfo::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

    // Handle 'Other' fields
    if ($request->prof_area_of_study_high_school_level === 'other') {
        $validatedData['prof_area_of_study_high_school_level'] = $request->prof_area_of_study_high_school_level_other;
    }

    if ($request->prof_area_of_specialisation === 'other') {
        $validatedData['prof_area_of_specialisation'] = $request->prof_area_of_specialisation_other;
    }

    if ($request->prof_award === 'other') {
        $validatedData['prof_award'] = $request->prof_award_other;
    }

    if ($request->prof_grade === 'other') {
        $validatedData['prof_grade'] = $request->prof_grade_other;
    }

    // Remove 'other' fields
    unset($validatedData['prof_area_of_study_high_school_level_other']);
    unset($validatedData['prof_area_of_specialisation_other']);
    unset($validatedData['prof_award_other']);
    unset($validatedData['prof_grade_other']);

    // Update the data
    $profInfo->update($validatedData);

    // Redirect back with a success message

    return redirect()->route('profile.prof-info')->with('message','Professional information updated successfully.');
}



public function saveProfInfo(Request $request)
{
    $rows = session()->get('rows', []);
    $user_id = Auth::id();
    if (count($rows) > 5) {
        return redirect()->back()->with('message', 'You are not allowed to submit more than 5 academic records.');
    }
    if (empty($rows)) {
        return redirect()->back()->with('message','Please add at least one row of data before submitting.');
    }

    // Define validation rules
    $rules = [
        'prof_institution_name' => 'required|string|max:50',
        'prof_student_admission_no' => 'nullable|string|max:50',

        'prof_area_of_study_high_school_level' => 'required|string|max:50',
        'prof_area_of_study_high_school_level_other' => 'nullable|string|max:50',

        'prof_area_of_specialisation' => 'required|string|max:50',
        'prof_area_of_specialisation_other' => 'nullable|string|max:50',

        'prof_award' => 'required|string|max:50',
        'prof_award_other' => 'nullable|string|max:50',

        'prof_course' => 'nullable|string|max:50',

        'prof_grade' => 'required|string|max:50',
        'prof_grade_other' => 'nullable|string|max:100',

        'prof_certificate_no' => 'nullable|string|max:50',
        'prof_start_date' => 'required|date',
        'prof_end_date' => 'required|date',
    ];

    $messages = [
        'prof_area_of_study_high_school_level_other.required_if' => 'Please specify your Area of Study.',
        'prof_area_of_specialisation_other.required_if' => 'Please specify your Area of Specialisation.',
        'prof_award_other.required_if' => 'Please specify your Professional Award.',
        'prof_grade_other.required_if' => 'Please specify your Grade.',
    ];

    // Validate each row
    foreach ($rows as $index => $row) {
        $validator = Validator::make($row, $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Handle 'Other' fields
        if ($row['prof_area_of_study_high_school_level'] === 'other') {
            $row['prof_area_of_study_high_school_level'] = $row['prof_area_of_study_high_school_level_other'];
        }

        if ($row['prof_area_of_specialisation'] === 'other') {
            $row['prof_area_of_specialisation'] = $row['prof_area_of_specialisation_other'];
        }

        if ($row['prof_award'] === 'other') {
            $row['prof_award'] = $row['prof_award_other'];
        }

        if ($row['prof_grade'] === 'other') {
            $row['prof_grade'] = $row['prof_grade_other'];
        }

        // Remove 'other' fields
        unset($row['prof_area_of_study_high_school_level_other']);
        unset($row['prof_area_of_specialisation_other']);
        unset($row['prof_award_other']);
        unset($row['prof_grade_other']);

        // Add user_id
        $row['user_id'] = $user_id;

        // Save to database
        ProfInfo::create($row);
    }
    $createdCount = count($rows);
activity()
    ->causedBy(auth()->user())
    ->withProperties([
        'user_email' => auth()->user()->email,
        'entries_count' => $createdCount,
        'institutions' => array_column($rows, 'prof_institution_name')
    ])
    ->log("Added $createdCount professional info entries");

    // Clear the session
    session()->forget('rows');

    
    return view('confirmation', [
        'message'  => 'Professional info submitted successfully!',
        'next_url' => route('profile.relevant-courses') // Adjust the route as needed.
    ]);

}

public function removeProfSessionRow(Request $request)
{
    $index = $request->input('index');
    $rows = session()->get('rows', []);
    if (isset($rows[$index])) {
        unset($rows[$index]);
        session()->put('rows', array_values($rows)); // Reindex the array
    }
    return redirect()->back()->with('message','Row removed successfully');

}

public function deleteProfInfo($id)
{
    $profInfo = ProfInfo::findOrFail($id);
    $profInfo->delete();

    return redirect()->back()->with('message','Row removed successfully');
}





public function showRelevantCourses(Request $request)
{
    if (Auth::user()->role !== 'user') {
        abort(403, 'Limited Action');
    }
    $userId = $request->user()->id; // Assuming the user ID is available via authenticated user
    $relevantCoursesSubmitted = RelevantCourses::where('user_id', $userId)->exists();
    
    // Retrieve stored data from the database
    $relevantCourses = RelevantCourses::where('user_id', Auth::id())->paginate(10);

    return view('users.profile.relevant-courses', [
        'relevantCourses' => $relevantCourses,   
        'relevantCoursesSubmitted'=>$relevantCoursesSubmitted,
    ]);
}public function addRelRow(Request $request)
{
    // Save each row to the session temporarily
    $row = $request->only([
        'rel_institution_name',
        'rel_course',
        'rel_certificate_no',
        'rel_issue_date',
    ]);

    // Note: Changed from 'rows' to 'rel_rows'
    $rows = session()->get('rel_rows', []);
    $rows[] = $row;
    session()->put('rel_rows', $rows);

    return redirect()->back()->with('message','Row added successfully. Please Save before proceeding');
}


public function saveRelevantCourses(Request $request)
{
    $rows = session()->get('rel_rows', []);
    $user_id = Auth::id();
    if (count($rows) > 5) {
        return redirect()->back()->with('message', 'You are not allowed to submit more than 5 academic records.');
    }
    if (empty($rows)) {

        return redirect()->back()->with('message','Please add at least one row of data before submitting.');
    }

    // Define validation rules
    $rules = [
        'rel_institution_name.*' => 'required|string|max:50',
        'rel_course.*' => 'required|string|max:50',
        'rel_certificate_no.*' => 'nullable|string|max:50',
        'rel_issue_date.*' => 'required|date',
    ];

    // Validate each row
    foreach ($rows as $row) {
        $validator = Validator::make($row, $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    // Save each row to the database
    foreach ($rows as $row) {
        $row['user_id'] = $user_id; // Add the user_id to the row data
        RelevantCourses::create($row);
    }
    // Update submission status
    

    // Clear the session
    session()->forget('rel_rows');
    $createdCount = count($rows);
activity()
    ->causedBy(auth()->user())
    ->withProperties([
        'user_email' => auth()->user()->email,
        'entries_count' => $createdCount,
        'entries_sample' => array_slice($rows, 0, 3) // Show first 3 entries as sample
    ])
    ->log("Submitted $createdCount relevant courses");
    // Update the form submission status in local storage
    
    return view('confirmation', [
        'message'  => 'Relevant Courses submitted successfully!',
        'next_url' => route('profile.attachments') // Adjust the route as needed.
    ]);


}
public function removeRelSessionRow(Request $request)
{
    $index = $request->input('index');
    $rows = session()->get('rel_rows', []); // Changed to rel_rows
    
    if (isset($rows[$index])) {
        unset($rows[$index]);
        session()->put('rel_rows', array_values($rows));
    }
    
    return redirect()->back()->with('message','Row removed successfully');
}

public function deleteRelInfo($id)
{
    $RelInfo = RelevantCourses::findOrFail($id);
    $RelInfo->delete();

    return redirect()->back()->with('message','Academic info deleted successfully');
}


public function editRelevantCourse($id)
{
    // Ensure the user is authenticated and owns the data
    $relevantCourse = RelevantCourses::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

    return view('users.profile.edit-relevant-course', [
        'relevantCourse' => $relevantCourse,
    ]);
}


public function updateRelevantCourse(Request $request, $id)
{
    // Define validation rules
    $rules = [
        'rel_institution_name' => 'required|string|max:50',
        'rel_course' => 'required|string|max:50',
        'rel_certificate_no' => 'nullable|string|max:50',
        'rel_issue_date' => 'required|date',
    ];

    // Validate the request data
    $validatedData = $request->validate($rules);

    // Ensure the user is authenticated and owns the data
    $relevantCourse = RelevantCourses::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

    // Update the data
    $relevantCourse->update($validatedData);

    // Redirect back with a success message

    return redirect()->route('profile.relevant-courses')->with( 'message','Relevant course updated successfully.');
}



}

