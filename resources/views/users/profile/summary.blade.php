<x-layout>
    <x-card class="p-10 mx-auto mt-24">
        <div class="container">
            
<div class="text-center my-4">
    <h1 class="text-3xl font-bold">Profile Summary</h1>
</div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('profile.save') }}" method="POST" >
                @csrf
                
                <div class="text-center my-4">
    <h1 class="text-3xl font-bold">Personal Information</h1>
</div>
                <li><b>Surname:</b> <input type="text" name="surname" value="{{ old('surname', $profileData['surname'] ?? '') }}"></li>
                    <li><b>First Name:</b> <input type="text" name="firstname" value="{{ old('firstname', $profileData['firstname'] ?? '') }}"></li>
                    <li><b>Last Name:</b> <input type="text" name="lastname" value="{{ old('lastname', $profileData['lastname'] ?? '') }}"></li>
                    <li><b>Salutation:</b> <input type="text" name="salutation" value="{{ old('salutation', $profileData['salutation'] ?? '') }}"></li>
                    <li><b>DOB:</b> <input type="date" name="dob" value="{{ old('dob', $profileData['dob'] ?? '') }}"></li>
                    <li><b>ID Number:</b> <input type="text" name="idno" value="{{ old('idno', $profileData['idno'] ?? '') }}"></li>
                    <li><b>KRA Pin:</b> <input type="text" name="kra_pin" value="{{ old('kra_pin', $profileData['kra_pin'] ?? '') }}"></li>
                    <li><b>Gender:</b> <input type="text" name="gender" value="{{ old('gender', $profileData['gender'] ?? '') }}"></li>
                    <li><b>Nationality:</b> <input type="text" name="nationality" value="{{ old('nationality', $profileData['nationality'] ?? '') }}"></li>
                    <li><b>Ethnicity:</b> <input type="text" name="ethnicity" value="{{ old('ethnicity', $profileData['ethnicity'] ?? '') }}"></li>
                    <li><b>Home County:</b> <input type="text" name="homecounty" value="{{ old('homecounty', $profileData['homecounty'] ?? '') }}"></li>
                    <li><b>Subcounty:</b> <input type="text" name="subcounty" value="{{ old('subcounty', $profileData['subcounty'] ?? '') }}"></li>
                    <li><b>Constituency:</b> <input type="text" name="constituency" value="{{ old('constituency', $profileData['constituency'] ?? '') }}"></li>
                    <li><b>Postal Address:</b> <input type="text" name="postal_address" value="{{ old('postal_address', $profileData['postal_address'] ?? '') }}"></li>
                    <li><b>Code:</b> <input type="text" name="code" value="{{ old('code', $profileData['code'] ?? '') }}"></li>
                    <li><b>Town/City:</b> <input type="text" name="town_city" value="{{ old('town_city', $profileData['town_city'] ?? '') }}"></li>
                    <li><b>Telephone Number:</b> <input type="text" name="telephone_num" value="{{ old('telephone_num', $profileData['telephone_num'] ?? '') }}"></li>
                    <li><b>Mobile Number:</b> <input type="text" name="mobile_num" value="{{ old('mobile_num', $profileData['mobile_num'] ?? '') }}"></li>
                    <li><b>Email Address:</b> <input type="email" name="email_address" value="{{ old('email_address', $profileData['email_address'] ?? '') }}"></li>
                    <li><b>Alt Contact Person:</b> <input type="text" name="alt_contact_person" value="{{ old('alt_contact_person', $profileData['alt_contact_person'] ?? '') }}"></li>
                    <li><b>Alt Contact Telephone Number:</b> <input type="text" name="alt_contact_telephone_num" value="{{ old('alt_contact_telephone_num', $profileData['alt_contact_telephone_num'] ?? '') }}"></li>
                    <li><b>Disability Question:</b> <input type="text" name="disability_question" value="{{ old('disability_question', $profileData['disability_question'] ?? '') }}"></li>
                    <li><b>Nature of Disability:</b> <input type="text" name="nature_of_disability" value="{{ old('nature_of_disability', $profileData['nature_of_disability'] ?? '') }}"></li>
                    <li><b>NCPD Registration Number:</b> <input type="text" name="ncpd_registration_no" value="{{ old('ncpd_registration_no', $profileData['ncpd_registration_no'] ?? '') }}"></li>
                    <li><b>Ministry:</b> <input type="text" name="ministry" value="{{ old('ministry', $profileData['ministry'] ?? '') }}"></li>
                    <li><b>Station:</b> <input type="text" name="station" value="{{ old('station', $profileData['station'] ?? '') }}"></li>
                    <li><b>Personal Employment Number:</b> <input type="text" name="personal_employment_number" value="{{ old('personal_employment_number', $profileData['personal_employment_number'] ?? '') }}"></li>
                    <li><b>Present Substantive Post:</b> <input type="text" name="present_substantive_post" value="{{ old('present_substantive_post', $profileData['present_substantive_post'] ?? '') }}"></li>
                    <li><b>Job Group/Scale/Grade:</b> <input type="text" name="job_grp_scale_grade" value="{{ old('job_grp_scale_grade', $profileData['job_grp_scale_grade'] ?? '') }}"></li>
                    <li><b>Date of Current Appointment:</b> <input type="date" name="date_of_current_appointment" value="{{ old('date_of_current_appointment', $profileData['date_of_current_appointment'] ?? '') }}"></li>
                    <li><b>Upgraded Post:</b> <input type="text" name="upgraded_post" value="{{ old('upgraded_post', $profileData['upgraded_post'] ?? '') }}"></li>
                    <li><b>Effective Date Previous Appointment:</b> <input type="date" name="effective_date_previous_appointment" value="{{ old('effective_date_previous_appointment', $profileData['effective_date_previous_appointment'] ?? '') }}"></li>
                    <li><b>On Secondment Organization:</b> <input type="text" name="on_secondment_organization" value="{{ old('on_secondment_organization', $profileData['on_secondment_organization'] ?? '') }}"></li>
                    <li><b>Designation:</b> <input type="text" name="designation" value="{{ old('designation', $profileData['designation'] ?? '') }}"></li>
                    <li><b>Job Group:</b> <input type="text" name="job_group" value="{{ old('job_group', $profileData['job_group'] ?? '') }}"></li>
                    <li><b>Terms of Service:</b> <input type="text" name="terms_of_service" value="{{ old('terms_of_service', $profileData['terms_of_service'] ?? '') }}"></li>
                </ul>

                
                <div class="text-center my-4">
    <h1 class="text-3xl font-bold">Academic Information</h1>
</div>

                <ul>
                    <li><b>Institution Name:</b> <input type="text" name="institution_name" value="{{ old('institution_name', $profileData['institution_name'] ?? '') }}"></li>
                    <li><b>Student Admission Number:</b> <input type="text" name="student_admission_no" value="{{ old('student_admission_no', $profileData['student_admission_no'] ?? '') }}"></li>
                    <li><b>Highschool:</b> <input type="text" name="highschool" value="{{ old('highschool', $profileData['highschool'] ?? '') }}"></li>
                    <li><b>Specialisation:</b> <input type="text" name="specialisation" value="{{ old('specialisation', $profileData['specialisation'] ?? '') }}"></li>
                    <li><b>Award:</b> <input type="text" name="award" value="{{ old('award', $profileData['award'] ?? '') }}"></li>
                    <li><b>Course:</b> <input type="text" name="course" value="{{ old('course', $profileData['course'] ?? '') }}"></li>
                    <li><b>Grade:</b> <input type="text" name="grade" value="{{ old('grade', $profileData['grade'] ?? '') }}"></li>
                    <li><b>Certificate Number:</b> <input type="text" name="certificate_no" value="{{ old('certificate_no', $profileData['certificate_no'] ?? '') }}"></li>
                    <li><b>Start Date:</b> <input type="date" name="start_date" value="{{ old('start_date', $profileData['start_date'] ?? '') }}"></li>
                    <li><b>End Date:</b> <input type="date" name="end_date" value="{{ old('end_date', $profileData['end_date'] ?? '') }}"></li>
                    <li><b>Graduation/Completion Date:</b> <input type="date" name="graduation_completion_date" value="{{ old('graduation_completion_date', $profileData['graduation_completion_date'] ?? '') }}"></li>
                </ul>

                
                <div class="text-center my-4">
    <h1 class="text-3xl font-bold">Professional Information</h1>
</div>
                <ul>
                    <li><b>Professional Institution Name:</b> <input type="text" name="prof_institution_name" value="{{ old('prof_institution_name', $profileData['prof_institution_name'] ?? '') }}"></li>
                    <li><b>Professional Student Admission Number:</b> <input type="text" name="prof_student_admission_no" value="{{ old('prof_student_admission_no', $profileData['prof_student_admission_no'] ?? '') }}"></li>
                    <li><b>Area of Study High School Level:</b> <input type="text" name="prof_area_of_study_high_school_level" value="{{ old('prof_area_of_study_high_school_level', $profileData['prof_area_of_study_high_school_level'] ?? '') }}"></li>
                    <li><b>Area of Specialisation:</b> <input type="text" name="prof_area_of_specialisation" value="{{ old('prof_area_of_specialisation', $profileData['prof_area_of_specialisation'] ?? '') }}"></li>
                    <li><b>Professional Award:</b> <input type="text" name="prof_award" value="{{ old('prof_award', $profileData['prof_award'] ?? '') }}"></li>
                    <li><b>Professional Course:</b> <input type="text" name="prof_course" value="{{ old('prof_course', $profileData['prof_course'] ?? '') }}"></li>
                    <li><b>Professional Grade:</b> <input type="text" name="prof_grade" value="{{ old('prof_grade', $profileData['prof_grade'] ?? '') }}"></li>
                    <li><b>Professional Certificate Number:</b> <input type="text" name="prof_certificate_no" value="{{ old('prof_certificate_no', $profileData['prof_certificate_no'] ?? '') }}"></li>
                    <li><b>Professional Start Date:</b> <input type="date" name="prof_start_date" value="{{ old('prof_start_date', $profileData['prof_start_date'] ?? '') }}"></li>
                    <li><b>Professional End Date:</b> <input type="date" name="prof_end_date" value="{{ old('prof_end_date', $profileData['prof_end_date'] ?? '') }}"></li>
                </ul>

                
                <div class="text-center my-4">
    <h1 class="text-3xl font-bold">Relevant Courses</h1>
</div>
                <ul>
                    <li><b>Relevant Course Institution Name:</b> <input type="text" name="rel_institution_name" value="{{ old('rel_institution_name', $profileData['rel_institution_name'] ?? '') }}"></li>
                    <li><b>Relevant Course:</b> <input type="text" name="rel_course" value="{{ old('rel_course', $profileData['rel_course'] ?? '') }}"></li>
                    <li><b>Relevant Certificate Number:</b> <input type="text" name="rel_certificate_no" value="{{ old('rel_certificate_no', $profileData['rel_certificate_no'] ?? '') }}"></li>
                    <li><b>Relevant Issue Date:</b> <input type="date" name="rel_issue_date" value="{{ old('rel_issue_date', $profileData['rel_issue_date'] ?? '') }}"></li>
                </ul>

                <div class="flex space-x-4">
                    <!-- Back Button -->
                    <a href="{{ route('profile.relevant-courses') }}" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        Back
                    </a>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </x-card>
</x-layout>
