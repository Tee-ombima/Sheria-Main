<?php

namespace App\Http\Controllers;

use App\Models\Prof_area_of_specialisation;
use App\Models\Prof_area_of_study_high_school_level;
use App\Models\Prof_award;
use App\Models\Prof_grade;
use App\Models\Specialisation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\ProfileInfo;
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
use App\Models\Subcounty;
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
    
        // Retrieve salutations from the database
        $salutations = Salutation::all();
        $ethnicities = Ethnicity::all();
        $homecounties = Homecounty::all();
        $countryCodes = CountryCode::all();
        
    
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
    // Validate the incoming request...
    
    $validatedData = $request->validate([
        'surname' => 'required|string|max:100',
            'firstname' => 'required|string|max:100',
            'lastname' => 'nullable|string|max:100',
            'salutation' => 'required|string',
            'dob' => 'required|date',
            'idno' => 'required|string|max:8',
            'kra_pin' => 'required|string|max:11',
            'gender' => 'required|in:male,female',
            'nationality' => 'required|string|max:50',
            'ethnicity' => 'required|string',
            
            'postal_address' => 'required|string',
            'code' => 'nullable|string',
            'town_city' => 'required|string|max:50',
            'telephone_num' => 'nullable|string',
            'mobile_num' => 'required|string',
            'email_address' => 'required|email|max:100',
            'alt_contact_person' => 'required|string|max:100',
            'alt_contact_telephone_num' => 'required|string',
            'disability_question' => 'nullable|string',
            'nature_of_disability' => 'nullable|string|max:100',
            'ncpd_registration_no' => 'nullable|string|max:100',
            
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
    ]);

    
    $user_id = Auth::id();
    
    // Save the data to the session
    $request->session()->put('inputData', $validatedData);

    // Optionally save to the database
    PersonalInfo::updateOrCreate(
        ['user_id' => $user_id], // Condition to find the existing record
        $validatedData // Data to update or create the record
    );
    
    

    session()->flash('message', 'Your action was successful!');
    return redirect()->route('profile.academic-info');

    



}





public function getSubcounties(Request $request)
{
    $homecountyName = $request->query('homecounty');
    $homecounty = Homecounty::where('name', $homecountyName)->first();
    $subcounties = $homecounty ? $homecounty->subcounties : [];
    return response()->json($subcounties);
}

public function getConstituencies(Request $request)
{
    $homecountyName = $request->query('homecounty');
    $homecounty = Homecounty::where('name', $homecountyName)->first();
    $constituencies = $homecounty ? $homecounty->constituencies : [];
    return response()->json($constituencies);
}
    



public function showAcademicInfo(Request $request)
{
    if (Auth::user()->role !== 'user') {
        abort(403, 'Limited Action');
    }
    $userId = $request->user()->id; // Assuming the user ID is available via authenticated user
    $academicInfoSubmitted = AcademicInfo::where('user_id', $userId)->exists();
    
    // Retrieve stored data from the database
    $academicInfos = AcademicInfo::where('user_id', Auth::id())->get();

    $awards = Award::all();
    $grades = Grade::all();
    $courses = Course::all();
    $specialisations = Specialisation::all();

    $highschools = Highschool::all();
    

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
    // Save each row to the session temporarily
    $row = $request->only([
        'institution_name', 
        'student_admission_no', 
        'highschool', 
        'specialisation', 
        'course', 
        'award', 
        'grade', 
        'certificate_no', 
        'start_date', 
        'end_date', 
        'graduation_completion_date'
    ]);

    $rows = session()->get('rows', []);
    $rows[] = $row;
    session()->put('rows', $rows);

    return redirect()->back();
}

public function saveAcademicInfo(Request $request)
{
    $rows = session()->get('rows', []);
    $user_id = Auth::id();
    if (empty($rows)) {
        return redirect()->back()->withErrors(['rows' => 'Please add at least one row of data before submitting.'])->withInput();
    }

    // Define validation rules
    $rules = [
        'institution_name' => 'required|string|max:100',
        'student_admission_no' => 'nullable|string|max:100',
        'highschool' => 'required|string',
        'specialisation' => 'required|string',
        'award' => 'required|string',
        'course' => 'required|string',
        'grade' => 'required|string|max:100',
        'certificate_no' => 'required|string|max:100',
        'start_date' => 'nullable|date',
        'end_date' => 'nullable|date',
        'graduation_completion_date' => 'nullable|date',
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
        AcademicInfo::create($row);
    }
    // Update submission status
    

    // Clear the session
    session()->forget('rows');
    
    // Update the form submission status in local storage
    echo "<script>localStorage.setItem('academic-info-submitted', 'true');</script>";
    session()->flash('message', 'Your action was successful!');
    return redirect()->route('profile.prof-info');


}
public function removeSessionRow(Request $request)
{
    $index = $request->input('index');
    $rows = session()->get('rows', []);
    if (isset($rows[$index])) {
        unset($rows[$index]);
        session()->put('rows', array_values($rows)); // Reindex the array
    }

    return response()->json(['message' => 'Row removed successfully']);
}

public function deleteAcademicInfo($id)
{
    $academicInfo = AcademicInfo::findOrFail($id);
    $academicInfo->delete();

    return redirect()->back()->with('success', 'Academic info deleted successfully');
}




public function showProfInfo(Request $request)
{
    if (Auth::user()->role !== 'user') {
        abort(403, 'Limited Action');
    }
    $userId = $request->user()->id; // Assuming the user ID is available via authenticated user
    $profInfoSubmitted = ProfInfo::where('user_id', $userId)->exists();
    
    // Retrieve stored data from the database
    $profInfos = ProfInfo::where('user_id', Auth::id())->get();

    $prof_awards = Prof_award::all();
    $prof_grades = Prof_grade::all();
    $prof_area_of_study_high_school_levels = Prof_area_of_study_high_school_level::all();
    $prof_area_of_specialisations = Prof_area_of_specialisation::all();
    

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
    // Save each row to the session temporarily
    $row = $request->only([
        
        'prof_institution_name',
        'prof_student_admission_no',
        'prof_area_of_study_high_school_level',
        'prof_area_of_specialisation',
        'prof_award',
        'prof_course',
        'prof_grade',
        'prof_certificate_no',
        'prof_start_date',
        'prof_end_date',
    ]);

    $rows = session()->get('rows', []);
    $rows[] = $row;
    session()->put('rows', $rows);

    return redirect()->back();
}

public function saveProfInfo(Request $request)
{
    $rows = session()->get('rows', []);
    $user_id = Auth::id();
    if (empty($rows)) {
        return redirect()->back()->withErrors(['rows' => 'Please add at least one row of data before submitting.'])->withInput();
    }

    // Define validation rules
    $rules = [
        'prof_institution_name.*' => 'required|string|max:100',
        'prof_student_admission_no.*' => 'nullable|string|max:100',
        'prof_area_of_study_high_school_level.*' => 'required|string',
        'prof_area_of_specialisation.*' => 'required|string',
        'prof_award.*' => 'required|string',
        'prof_course.*' => 'nullable|string|max:100',
        'prof_grade.*' => 'required|string|max:100',
        'prof_certificate_no.*' => 'nullable|string|max:100',
        'prof_start_date.*' => 'required|date',
        'prof_end_date.*' => 'required|date',
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
        ProfInfo::create($row);
    }
    // Update submission status
    

    // Clear the session
    session()->forget('rows');
    
    // Update the form submission status in local storage
    echo "<script>localStorage.setItem('academic-info-submitted', 'true');</script>";
    session()->flash('message', 'Your action was successful!');
    return redirect()->route('profile.relevant-courses');


}
public function removeProfSessionRow(Request $request)
{
    $index = $request->input('index');
    $rows = session()->get('rows', []);
    if (isset($rows[$index])) {
        unset($rows[$index]);
        session()->put('rows', array_values($rows)); // Reindex the array
    }

    return response()->json(['message' => 'Row removed successfully']);
}

public function deleteProfInfo($id)
{
    $profInfo = ProfInfo::findOrFail($id);
    $profInfo->delete();

    return redirect()->back()->with('success', 'Academic info deleted successfully');
}





public function showRelevantCourses(Request $request)
{
    if (Auth::user()->role !== 'user') {
        abort(403, 'Limited Action');
    }
    $userId = $request->user()->id; // Assuming the user ID is available via authenticated user
    $relevantCoursesSubmitted = RelevantCourses::where('user_id', $userId)->exists();
    
    // Retrieve stored data from the database
    $relevantCourses = RelevantCourses::where('user_id', Auth::id())->get();

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

    return redirect()->back();
}

public function saveRelevantCourses(Request $request)
{
    $rows = session()->get('rows', []);
    $user_id = Auth::id();
    if (empty($rows)) {
        return redirect()->back()->withErrors(['rows' => 'Please add at least one row of data before submitting.'])->withInput();
    }

    // Define validation rules
    $rules = [
        'rel_institution_name.*' => 'required|string|max:100',
        'rel_course.*' => 'required|string|max:100',
        'rel_certificate_no.*' => 'nullable|string|max:100',
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
    session()->flash('message', 'Your action was successful!');
    return redirect()->route('profile.attachments');


}
public function removeRelSessionRow(Request $request)
{
    $index = $request->input('index');
    $rows = session()->get('rows', []);
    if (isset($rows[$index])) {
        unset($rows[$index]);
        session()->put('rows', array_values($rows)); // Reindex the array
    }

    return response()->json(['message' => 'Row removed successfully']);
}

public function deleteRelInfo($id)
{
    $RelInfo = RelevantCourses::findOrFail($id);
    $RelInfo->delete();

    return redirect()->back()->with('success', 'Academic info deleted successfully');
}

public function statusindex($userId)
    {
        $personalInfoSubmitted = PersonalInfo::where('user_id', $userId)->exists();
        $academicInfoSubmitted = AcademicInfo::where('user_id', $userId)->exists();
        $profInfoSubmitted = ProfInfo::where('user_id', $userId)->exists();
        $relevantCoursesSubmitted = RelevantCourses::where('user_id', $userId)->exists();

        return view('submission_status', compact(
            'personalInfoSubmitted',
            'academicInfoSubmitted',
            'profInfoSubmitted',
            'relevantCoursesSubmitted'
        ));
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
//             'idno' => 'required|string|max:8',
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

//         return redirect()->route('/')->with('success', 'Profile information saved successfully!');
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