<?php

namespace App\Http\Controllers;

use App\Models\Prof_area_of_specialisation;
use App\Models\Prof_area_of_study_high_school_level;
use App\Models\Prof_award;
use App\Models\Prof_grade;
use App\Models\Specialisation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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


use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    



    public function showPersonalInfo(Request $request)
    {
        
        $userId = $request->user()->id; // Assuming the user ID is available via authenticated user
        $personalInfoSubmitted = PersonalInfo::where('user_id', $userId)->exists();
        $inputData = $request->session()->get('inputData', []);
    
        // Retrieve and sort salutations from the database (ensure 'other' is last)
    $salutations = Salutation::orderByRaw("name = 'other' DESC, name ASC")->get();
    
    // Retrieve and sort ethnicities from the database (ensure 'other' is last)
    $ethnicities = Ethnicity::orderByRaw("name = 'other' DESC, name ASC")->get();
    
    // Retrieve and sort home counties from the database (ensure 'other' is last)
    $homecounties = Homecounty::orderByRaw("name = 'other' DESC, name ASC")->get();
    
    // Retrieve and sort country codes from the database (ensure 'other' is last)
    $countryCodes = CountryCode::orderByRaw("name = 'other' DESC, name ASC")->get();
        
    
        // Pass personalInfo and salutations to the view
        return view('users.profile.personal-info', [
            'inputData' => $inputData,
            'personalInfoSubmitted'=>$personalInfoSubmitted,
            'salutations' => $salutations,
            'ethnicities' => $ethnicities,
            'homecounties' => $homecounties,
            'countryCodes' => $countryCodes,
            
        ]);
    }

public function savePersonalInfo(Request $request)
{
    // Validate the incoming request
    $validatedData = $request->validate([
        // Personal Information
        'surname' => 'required|string|max:50',
        'firstname' => 'required|string|max:50',
        'lastname' => 'nullable|string|max:50',
        'dob' => 'required|date',
        'idno' => 'required|integer',
        'kra_pin' => 'required|string|max:11',
        'nationality' => 'required|string|max:50',

        // Salutation
        'salutation' => 'required|string|max:50',
        'salutation_other' => 'nullable|string|max:50',

        // Ethnicity
        'ethnicity' => 'required|string|max:50',
        'ethnicity_other' => 'nullable|string|max:50',

        // Homecounty
        'homecounty_id' => [
            'required',
            'string',
            function ($attribute, $value, $fail) {
                if ($value !== 'other' && $value !== 'Other' && !Homecounty::where('id', $value)->exists()) {
                    $fail('The selected home county is invalid.');
                }
            },
        ],
        'homecounty_other' => 'nullable|string|max:50',

        // Constituency
        'constituency_id' => [
            'required',
            'string',
            function ($attribute, $value, $fail) {
                if ($value !== 'other' && $value !== 'Other' && !Constituency::where('id', $value)->exists()) {
                    $fail('The selected constituency is invalid.');
                }
            },
        ],
        'constituency_other' => 'nullable|string|max:50',

        // Subcounty
        'subcounty_id' => [
            'required',
            'string',
            function ($attribute, $value, $fail) {
                if ($value !== 'other' && $value !== 'Other' && !Subcounty::where('id', $value)->exists()) {
                    $fail('The selected subcounty is invalid.');
                }
            },
        ],
        'subcounty_other' => 'nullable|string|max:50',

        // Contact Information
        'postal_address' => 'required|string',
        'code' => 'nullable|numeric',
        'town_city' => 'required|string|max:50',
        'telephone_num' => 'nullable|integer',
        'mobile_num' => 'required|integer',
        'email_address' => 'required|email|max:100',
        'alt_contact_person' => 'required|string|max:100',
        'alt_contact_telephone_num' => 'required|integer',
        'disability_question' => 'nullable|string',
        'nature_of_disability' => 'nullable|string|max:100',
        'ncpd_registration_no' => 'nullable|string|max:100',

        // Employment Information
        'ministry' => 'nullable|string|max:100',
        'station' => 'nullable|string|max:100',
        'personal_employment_number' => 'nullable|string|max:100',
        'present_substantive_post' => 'nullable|string|max:100',
        'job_grp_scale_grade' => 'nullable|string|max:100',
        'date_of_current_appointment' => 'nullable|date',
        'upgraded_post' => 'nullable|string|max:100',
        'effective_date_previous_appointment' => 'nullable|date',
        'on_secondment_organization' => 'nullable|string|max:100',
        'designation' => 'nullable|string|max:100',
        'job_group' => 'nullable|string|max:100',
        'terms_of_service' => 'nullable|string',
    ], [
        // Custom error messages
        'salutation_other.required_if' => 'Please specify your salutation.',
        'ethnicity_other.required_if' => 'Please specify your ethnicity.',
        'homecounty_other.required_if' => 'Please specify your home county.',
        'constituency_other.required_if' => 'Please specify your constituency.',
        'subcounty_other.required_if' => 'Please specify your subcounty.',
    ]);

    $user_id = Auth::id();

    $data = $validatedData; // Initialize $data with validated data

    // Handle Salutation
    if (strtolower($request->salutation) === 'other') {
        $data['salutation'] = $request->salutation_other;
    }

    // Handle Ethnicity
    if (strtolower($request->ethnicity) === 'other') {
        $data['ethnicity'] = $request->ethnicity_other;
    }

    // Handle Homecounty
    if (strtolower($request->homecounty_id) !== 'other') {
        $homecounty = Homecounty::find($request->homecounty_id);
    } else {
        $homecounty = Homecounty::firstOrCreate(
            ['name' => $request->homecounty_other],
            ['added_by_user' => true]
        );
    }

    // Handle Constituency
    if (strtolower($request->constituency_id) !== 'other') {
        $constituency = Constituency::find($request->constituency_id);
    } else {
        $constituency = Constituency::firstOrCreate(
            [
                'name' => $request->constituency_other,
                'homecounty_id' => $homecounty->id,
            ],
            ['added_by_user' => true]
        );
    }

    // Handle Subcounty
    if (strtolower($request->subcounty_id) !== 'other') {
        $subcounty = Subcounty::find($request->subcounty_id);
    } else {
        $subcounty = Subcounty::firstOrCreate(
            [
                'name' => $request->subcounty_other,
                'constituency_id' => $constituency->id,
            ],
            ['added_by_user' => true]
        );
    }

    // Update IDs in data
    $data['homecounty_id'] = $homecounty->id;
    $data['constituency_id'] = $constituency->id;
    $data['subcounty_id'] = $subcounty->id;
    $data['user_id'] = $user_id;

    // Remove 'other' fields from data
    unset(
        $data['salutation_other'],
        $data['ethnicity_other'],
        $data['homecounty_other'],
        $data['constituency_other'],
        $data['subcounty_other']
    );

    // Save to the database
    PersonalInfo::updateOrCreate(
        ['user_id' => $user_id],
        $data
    );

    // Save the data to the session if needed
    $request->session()->put('inputData', $data);

    return redirect()->route('profile.academic-info')->with('message', 'Profile Information submitted successfully!');
}



public function showAcademicInfo(Request $request)
{
    if (Auth::user()->role !== 'user') {
        abort(403, 'Limited Action');
    }
    $userId = $request->user()->id; // Assuming the user ID is available via authenticated user
    $academicInfoSubmitted = AcademicInfo::where('user_id', $userId)->exists();
    
    // Retrieve stored data from the database
    $academicInfos = AcademicInfo::where('user_id', Auth::id())->paginate(10); // Adjust the number per page as needed

    $awards = Award::orderByRaw("name = 'other' DESC, name ASC")->get();

    $grades = Grade::orderByRaw("name = 'other' DESC, name ASC")->get();
    $courses = Course::orderByRaw("name = 'other' DESC, name ASC")->get();
    $specialisations = Specialisation::orderByRaw("name = 'other' DESC, name ASC")->get();

    $highschools = Highschool::orderByRaw("name = 'other' DESC, name ASC")->get();
    

    return view('users.profile.academic-info', [
        'academicInfos' => $academicInfos,
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

    // Clear the session
    session()->forget('rows');

    return redirect()->route('profile.prof-info')->with('message','Academic Information submitted successfully!');
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
    $profInfos = ProfInfo::where('user_id', $userId)->paginate(10); // Get all records, not paginated

    $prof_awards = Prof_award::orderByRaw("name = 'other' DESC, name ASC")->get();
    $prof_grades = Prof_grade::orderByRaw("name = 'other' DESC, name ASC")->get();
    $prof_area_of_study_high_school_levels = Prof_area_of_study_high_school_level::orderByRaw("name = 'other' DESC, name ASC")->get();
    $prof_area_of_specialisations = Prof_area_of_specialisation::orderByRaw("name = 'other' DESC, name ASC")->get();
    

    return view('users.profile.prof-info', [
        'profInfos' => $profInfos,
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

    // Clear the session
    session()->forget('rows');

    return redirect()->route('profile.relevant-courses')->with('message','Professional info submitted successfully');
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
}
public function addRelRow(Request $request)
{
    // Save each row to the session temporarily
    $row = $request->only([
        
        'rel_institution_name',
        'rel_course',
        'rel_certificate_no',
        'rel_issue_date',
    ]);

    $rows = session()->get('rows', []);
    $rows[] = $row;
    session()->put('rows', $rows);



    return redirect()->back()->with('message','Row added successfully.Please Save before proceeding');
}

public function saveRelevantCourses(Request $request)
{
    $rows = session()->get('rows', []);
    $user_id = Auth::id();
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
    session()->forget('rows');
    
    // Update the form submission status in local storage
    echo "<script>localStorage.setItem('relevant-courses-submitted', 'true');</script>";
    return redirect()->route('profile.attachments')->with('message','Relevant Courses submitted successfully');


}
public function removeRelSessionRow(Request $request)
{
    $index = $request->input('index');
    $rows = session()->get('rows', []);
    if (isset($rows[$index])) {
        unset($rows[$index]);
        session()->put('rows', array_values($rows)); // Reindex the array
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



// public function showSummary()
//     {
//         if (Auth::user()->role !== 'user') {
//             abort(403, 'Limited Action');
//         }

//         $profileData = session('profile_data', []);

//         return view('users.profile.summary', compact('profileData'));
//     }

//     public function saveProfile(Request $request)
//     {
//         // Validate the request data
//         $validatedData = $request->validate([
//             // Personal Info
//             'surname' => 'required|string|max:100',
//             'firstname' => 'required|string|max:100',
//             'lastname' => 'nullable|string|max:100',
//             'salutation' => 'required|string',
//             'dob' => 'required|date',
//             'idno' => 'required|string',
//             'kra_pin' => 'required|string|max:11',
//             'gender' => 'required|in:male,female',
//             'nationality' => 'required|string|max:50',
//             'ethnicity' => 'required|string',
//             'homecounty' => 'required|string',
//             'subcounty' => 'required|string',
//             'constituency' => 'nullable|string|max:100',
//             'postal_address' => 'required|string',
//             'code' => 'nullable|string',
//             'town_city' => 'required|string|max:50',
//             'telephone_num' => 'nullable|string',
//             'mobile_num' => 'required|string',
//             'email_address' => 'required|email|max:100',
//             'alt_contact_person' => 'required|string|max:100',
//             'alt_contact_telephone_num' => 'required|string',
//             'disability_question' => 'nullable|string',
//             'nature_of_disability' => 'nullable|string|max:100',
//             'ncpd_registration_no' => 'nullable|string|max:100',
//             'ministry' => 'required|string|max:100',
//             'station' => 'required|string|max:100',
//             'personal_employment_number' => 'required|string|max:100',
//             'present_substantive_post' => 'required|string|max:100',
//             'job_grp_scale_grade' => 'required|string|max:100',
//             'date_of_current_appointment' => 'nullable|date',
//             'upgraded_post' => 'required|string|max:100',
//             'effective_date_previous_appointment' => 'nullable|date',
//             'on_secondment_organization' => 'required|string|max:100',
//             'designation' => 'required|string|max:100',
//             'job_group' => 'required|string|max:100',
//             'terms_of_service' => 'nullable|string',

//             // Academic Info
//             'institution_name' => 'required|string|max:100',
//             'student_admission_no' => 'nullable|string|max:100',
//             'highschool' => 'required|string',
//             'specialisation' => 'required|string',
//             'award' => 'required|string',
//             'course' => 'required|string',
//             'grade' => 'required|string|max:100',
//             'certificate_no' => 'required|string|max:100',
//             'start_date' => 'nullable|date',
//             'end_date' => 'nullable|date',
//             'graduation_completion_date' => 'nullable|date',

//             // Professional Info
//             'prof_institution_name' => 'required|string|max:100',
//             'prof_student_admission_no' => 'nullable|string|max:100',
//             'prof_area_of_study_high_school_level' => 'required|string',
//             'prof_area_of_specialisation' => 'required|string',
//             'prof_award' => 'required|string',
//             'prof_course' => 'nullable|string|max:100',
//             'prof_grade' => 'required|string|max:100',
//             'prof_certificate_no' => 'nullable|string|max:100',
//             'prof_start_date' => 'required|date',
//             'prof_end_date' => 'required|date',

//             // Relevant Courses Info
//             'rel_institution_name' => 'required|string|max:100',
//             'rel_course' => 'required|string|max:100',
//             'rel_certificate_no' => 'nullable|string|max:100',
//             'rel_issue_date' => 'required|date',
//         ]);

//         $user_id = Auth::id();

//         // ProfileInfo::create(array_merge($validatedData, ['user_id' => $user_id]));

//         return redirect()->route('/')->with('message', 'Profile information saved successfully!');
//     }





// }

// public function showProBodies()
// {
//     if (Auth::user()->role !== 'user') {
//         abort(403, 'Limited Action');
//     }
//     // Retrieve stored data from session
//     $data = session()->get('profileData', []);
//     return view('users.profile.pro-bodies', compact('data'));
// }

// public function saveProBodies(Request $request)
// {
//     if (Auth::user()->role !== 'user') {
//         abort(403, 'Limited Action');
//     }
//     // Define validation rules
//     $rules = [
//         'professional_body' => 'required|max:100',
//         'membership_type' => 'required|max:100',
//         'membership_num' => 'required|max:100',
//         'mem_start_date' => 'required|date',
//         'mem_end_date' => 'required|date',
//     ];

//     // Validate and save data
//     $validatedData = $request->validate($rules);

//     // Store data in session
//     session()->put('profileData', array_merge(session()->get('profileData', []), $validatedData));

//     // Redirect to the next step
//     return redirect()->route('profile.emp-details');
// }


// public function showEmpDetails()
// {
//     if (Auth::user()->role !== 'user') {
//         abort(403, 'Limited Action');
//     }
//     // Retrieve stored data from session
//     $data = session()->get('profileData', []);
//     return view('users.profile.emp-details', compact('data'));
// }

// public function saveEmpDetails(Request $request)
// {
//     if (Auth::user()->role !== 'user') {
//         abort(403, 'Limited Action');
//     }
//     // Define validation rules
//     $rules = [
//         'position' => 'required|max:100',
//         'salary' => 'required|max:100',
//         'ministry' => 'required|max:100',
//         'nature_of_work' => 'required|max:100',
//         'emp_start_date' => 'required|date',
//         'emp_end_date' => 'required|date',
//     ];

//     // Validate and save data
//     $validatedData = $request->validate($rules);

//     // Store data in session
//     session()->put('profileData', array_merge(session()->get('profileData', []), $validatedData));

//     // Redirect to the next step
//     return redirect()->route('profile.referees');
// }


// public function showReferees()
// {
//     if (Auth::user()->role !== 'user') {
//         abort(403, 'Limited Action');
//     }
//     // Retrieve stored data from session
//     $data = session()->get('profileData', []);
//     return view('users.profile.referees', compact('data'));
// }

// public function saveReferees(Request $request)
// {
//     if (Auth::user()->role !== 'user') {
//         abort(403, 'Limited Action');
//     }
//     // Define validation rules
//     $rules = [
//         'ref_surname' => 'required|max:100',
//         'ref_firstname' => 'required|max:100',
//         'ref_postal_address' => 'required|max:255',
//         'ref_code' => 'required|max:100',
//         'ref_town_city' => 'required|max:100',
//         'ref_mobile' => 'required|max:100',
//         'ref_email_address' => 'required|email|max:100',
//         'ref_designation' => 'required|integer',
//     ];

//     // Validate and save data
//     $validatedData = $request->validate($rules);

//     // Store data in session
//     session()->put('profileData', array_merge(session()->get('profileData', []), $validatedData));

//     // Redirect to the next step
//     return redirect()->route('profile.summary');
// }