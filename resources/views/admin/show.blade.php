<x-layout>
    <h1 class="text-3xl font-bold mb-6">{{ $listing->title }}</h1>
    <div class="bg-white shadow-md rounded-lg mb-6">
        <div class="p-4">
            <!-- Form to update application status -->
            <form action="{{ route('admin.updateStatus') }}" method="POST" class="bg-white shadow-md rounded-lg p-6">
                @csrf
                <input type="hidden" name="job_id" value="{{ $listing->id }}">

            <h2 class="text-2xl font-semibold mb-4 text-center">Manage Applications</h2>

                <!-- Filter by Job Status -->
                <div class="mb-4">
                    <label for="status-filter" class="block text-sm font-medium text-gray-700">Filter by Job Status</label>
                    <select id="status-filter" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" onchange="filterByStatus(this.value)">
                        <option value="">All</option>
                        <option value="Processing">Processing</option>
                        <option value="Selected">Selected for interview</option>
                        <option value="Appointed">Appointed</option>
                        <option value="Rejected">Not Successful</option>
                    </select>
                </div>

                <!-- Total Emails Count and Status Counts -->
                <div class="mb-4 flex justify-between items-center">
                    <p><strong>Total Emails:</strong> <span id="total-emails">{{ $applications->total() }}</span></p>
                    <div class="flex space-x-4">
                        <p><strong>Processing:</strong> <span id="processing-count">{{ $processingCount }}</span></p>
                        <p><strong>Selected:</strong> <span id="selected-count" style="color: #fbae1b;">{{ $selectedCount }}</span></p>
                        <p><strong>Appointed:</strong> <span id="appointed-count" style="color: green;">{{ $appointedCount }}</span></p>
                        <p><strong>Rejected:</strong> <span id="rejected-count" style="color: red;">{{ $rejectedCount }}</span></p>
                        <p><strong>Sum:</strong> <span id="sum-count">{{ $sumCount }}</span></p>
                    </div>
                </div>

                <!-- Email Matrix with Toggle -->
                <div class="mb-4" id="applications-container">
                    @foreach($applications as $index => $application)
                        <div class="mb-2 application-row" data-status="{{ $application->job_status }}">
                            <div class="flex items-center cursor-pointer email-row" x-data="{ open: false }">
                                <label for="email-{{ $application->user->id }}" class="text-sm font-medium text-gray-700 flex-1" @click="open = !open">
                                    {{ $application->user->email }}
                                </label>
                                <!-- Display job status next to the email with conditional colors -->
                                <span class="ml-2 status-display" 
                                      style="color: 
                                      {{ $application->job_status === 'Selected' ? '#fbae1b' : 
                                         ($application->job_status === 'Appointed' ? 'green' : 
                                         ($application->job_status === 'Rejected' ? 'red' : 'black')) }};">
                                    {{ $application->job_status }}
                                </span>
                                <!-- Dropdown Icon -->
                                <span class="ml-2 dropdown-icon cursor-pointer" onclick="toggleDetails(this)">
                                    ▼
                                </span>
                            </div>

                            <!-- Details Section -->
                            <div class="ml-4 mt-2 hidden details-section">
                                <!-- Personal Info Section -->
<div x-data="{ open: false, personalInfo: {} }" x-init="
    // Simulating data retrieval
    personalInfo = {
        id: 1,
        user_id: 11,
        surname: 'Smith',
        firstname: 'John',
        dob: '1990-05-10',
        id_no: '12345678',
        kra_pin: 'KRA12345',
        gender: 'Male',
        email: 'john.smith@example.com',
        mobile: '0712345678',
        postal_address: 'P.O. Box 123, Nairobi',
        town: 'Nairobi',
        alt_contact_person: 'Jane Doe',
        alt_contact_number: '0723456789',
        ministry: 'Education',
        station: 'Nairobi West',
        employment_number: 'EMP12345',
        current_post: 'Teacher',
        job_group: 'Group D',
        service_terms: 'Permanent',
        disability: 'None',
        nature_of_disability: 'N/A',
        ncpd_registration_no: 'N/A',
        designation: 'N/A',
        date_of_appointment: '2020-01-15',
        upgraded_post: 'N/A',
        effective_date_previous_appointment: '2019-01-10',
        on_secondment_organization: 'N/A',
        created_at: '2024-09-22',
        updated_at: '2024-09-23',
        home_county: 'Nairobi',
        constituency: 'Westlands',
        subcounty: 'Kangemi',
        ethnicity: 'Default',
        nationality: 'Kenyan',
        personal_employment_no: 'EMP56789'
    };
">
    <h4 @click="open = !open" class="text-md font-semibold cursor-pointer">Personal Info</h4>
    <table x-show="open" class="table-auto mt-1 ml-4 border-collapse w-full">
        <thead>
            <tr>
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">User ID</th>
                <th class="border px-4 py-2">Surname</th>
                <th class="border px-4 py-2">Firstname</th>
                <th class="border px-4 py-2">Dob</th>
                <th class="border px-4 py-2">Id No</th>
                <th class="border px-4 py-2">KRA Pin</th>
                <th class="border px-4 py-2">Gender</th>
                <th class="border px-4 py-2">Email</th>
                <th class="border px-4 py-2">Mobile</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="border px-4 py-2" x-text="personalInfo.id"></td>
                <td class="border px-4 py-2" x-text="personalInfo.user_id"></td>
                <td class="border px-4 py-2" x-text="personalInfo.surname"></td>
                <td class="border px-4 py-2" x-text="personalInfo.firstname"></td>
                <td class="border px-4 py-2" x-text="personalInfo.dob"></td>
                <td class="border px-4 py-2" x-text="personalInfo.id_no"></td>
                <td class="border px-4 py-2" x-text="personalInfo.kra_pin"></td>
                <td class="border px-4 py-2" x-text="personalInfo.gender"></td>
                <td class="border px-4 py-2" x-text="personalInfo.email"></td>
                <td class="border px-4 py-2" x-text="personalInfo.mobile"></td>
            </tr>
            <tr>
                <td class="border px-4 py-2 font-semibold">Postal Address</td>
                <td class="border px-4 py-2 font-semibold">Town/City</td>
                <td class="border px-4 py-2 font-semibold">Alt Contact Person</td>
                <td class="border px-4 py-2 font-semibold">Alt Contact Number</td>
                <td class="border px-4 py-2 font-semibold">Ministry</td>
                <td class="border px-4 py-2 font-semibold">Station</td>
                <td class="border px-4 py-2 font-semibold">Employment Number</td>
                <td class="border px-4 py-2 font-semibold">Current Post</td>
                <td class="border px-4 py-2 font-semibold">Job Group</td>
                <td class="border px-4 py-2 font-semibold">Service Terms</td>
            </tr>
            <tr>
                <td class="border px-4 py-2" x-text="personalInfo.postal_address"></td>
                <td class="border px-4 py-2" x-text="personalInfo.town"></td>
                <td class="border px-4 py-2" x-text="personalInfo.alt_contact_person"></td>
                <td class="border px-4 py-2" x-text="personalInfo.alt_contact_number"></td>
                <td class="border px-4 py-2" x-text="personalInfo.ministry"></td>
                <td class="border px-4 py-2" x-text="personalInfo.station"></td>
                <td class="border px-4 py-2" x-text="personalInfo.employment_number"></td>
                <td class="border px-4 py-2" x-text="personalInfo.current_post"></td>
                <td class="border px-4 py-2" x-text="personalInfo.job_group"></td>
                <td class="border px-4 py-2" x-text="personalInfo.service_terms"></td>
            </tr>
            <tr>
                <td class="border px-4 py-2 font-semibold">Disability</td>
                <td class="border px-4 py-2 font-semibold">Nature of Disability</td>
                <td class="border px-4 py-2 font-semibold">NCPD Registration No</td>
                <td class="border px-4 py-2 font-semibold">Designation</td>
                <td class="border px-4 py-2 font-semibold">Date of Current Appointment</td>
                <td class="border px-4 py-2 font-semibold">Upgraded Post</td>
                <td class="border px-4 py-2 font-semibold">Effective Date Previous Appointment</td>
                <td class="border px-4 py-2 font-semibold">On Secondment Organization</td>
                <td class="border px-4 py-2 font-semibold">Created At</td>
                <td class="border px-4 py-2 font-semibold">Updated At</td>
            </tr>
            <tr>
                <td class="border px-4 py-2" x-text="personalInfo.disability"></td>
                <td class="border px-4 py-2" x-text="personalInfo.nature_of_disability"></td>
                <td class="border px-4 py-2" x-text="personalInfo.ncpd_registration_no"></td>
                <td class="border px-4 py-2" x-text="personalInfo.designation"></td>
                <td class="border px-4 py-2" x-text="personalInfo.date_of_appointment"></td>
                <td class="border px-4 py-2" x-text="personalInfo.upgraded_post"></td>
                <td class="border px-4 py-2" x-text="personalInfo.effective_date_previous_appointment"></td>
                <td class="border px-4 py-2" x-text="personalInfo.on_secondment_organization"></td>
                <td class="border px-4 py-2" x-text="personalInfo.created_at"></td>
                <td class="border px-4 py-2" x-text="personalInfo.updated_at"></td>
            </tr>
            <tr>
                <td class="border px-4 py-2 font-semibold">Home County</td>
                <td class="border px-4 py-2 font-semibold">Constituency</td>
                <td class="border px-4 py-2 font-semibold">Subcounty</td>
                <td class="border px-4 py-2 font-semibold">Ethnicity</td>
                <td class="border px-4 py-2 font-semibold">Nationality</td>
                <td class="border px-4 py-2 font-semibold">Personal Employment No</td>
                <td class="border px-4 py-2 font-semibold">N/A</td>
                <td class="border px-4 py-2 font-semibold">N/A</td>
                <td class="border px-4 py-2 font-semibold">N/A</td>
                <td class="border px-4 py-2 font-semibold">N/A</td>
            </tr>
            <tr>
                <td class="border px-4 py-2" x-text="personalInfo.home_county"></td>
                <td class="border px-4 py-2" x-text="personalInfo.constituency"></td>
                <td class="border px-4 py-2" x-text="personalInfo.subcounty"></td>
                <td class="border px-4 py-2" x-text="personalInfo.ethnicity"></td>
                <td class="border px-4 py-2" x-text="personalInfo.nationality"></td>
                <td class="border px-4 py-2" x-text="personalInfo.personal_employment_no"></td>
                <td class="border px-4 py-2">N/A</td>
                <td class="border px-4 py-2">N/A</td>
                <td class="border px-4 py-2">N/A</td>
                <td class="border px-4 py-2">N/A</td>
            </tr>
        </tbody>
    </table>
</div>



                                <!-- Academic Info Section -->
<div x-data="{ open: false }">
    <h4 @click="open = !open" class="text-md font-semibold cursor-pointer">Academic Info</h4>
    <table x-show="open" class="table-auto mt-1 ml-4 border-collapse w-full">
        <thead>
            <tr>
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">User ID</th>
                <th class="border px-4 py-2">Institution Name</th>
                <th class="border px-4 py-2">Admission No</th>
                <th class="border px-4 py-2">High School</th>
                <th class="border px-4 py-2">Specialization</th>
                <th class="border px-4 py-2">Course</th>
                <th class="border px-4 py-2">Award</th>
                <th class="border px-4 py-2">Grade</th>
                <th class="border px-4 py-2">Certificate No</th>
                <th class="border px-4 py-2">Start Date</th>
                <th class="border px-4 py-2">End Date</th>
                <th class="border px-4 py-2">Graduation Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($application->user->academicInfo as $info)
                <tr>
                    <td class="border px-4 py-2">{{ $info->id }}</td>
                    <td class="border px-4 py-2">{{ $info->user_id }}</td>
                    <td class="border px-4 py-2">{{ $info->institution_name }}</td>
                    <td class="border px-4 py-2">{{ $info->admission_no }}</td>
                    <td class="border px-4 py-2">{{ $info->highschool }}</td>
                    <td class="border px-4 py-2">{{ $info->specialization }}</td>
                    <td class="border px-4 py-2">{{ $info->course }}</td>
                    <td class="border px-4 py-2">{{ $info->award }}</td>
                    <td class="border px-4 py-2">{{ $info->grade }}</td>
                    <td class="border px-4 py-2">{{ $info->certificate_no }}</td>
                    <td class="border px-4 py-2">{{ $info->start_date }}</td>
                    <td class="border px-4 py-2">{{ $info->end_date }}</td>
                    <td class="border px-4 py-2">{{ $info->graduation_date }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>



                               <!-- Professional Info Section -->
<div x-data="{ open: false, professionalInfo: {} }" x-init="
    // Simulating data retrieval
    professionalInfo = {
        id: 1,
        user_id: 11,
        institution_name: 'Reichel, Hilpert and Stracke',
        admission_no: '17317444',
        area_of_study: 'GeoScience',
        specialisation: 'Crop Production',
        course: 'Diploma in Information Technology',
        award: 'Diploma',
        grade: 'Distinction',
        certificate_no: '10085924',
        start_date: '1998-10-29',
        end_date: '2003-10-14'
    };
">
    <h4 @click="open = !open" class="text-md font-semibold cursor-pointer">Professional Info</h4>
    <table x-show="open" class="table-auto mt-1 ml-4 border-collapse w-full">
        <thead>
            <tr>
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">User ID</th>
                <th class="border px-4 py-2">Institution Name</th>
                <th class="border px-4 py-2">Admission No</th>
                <th class="border px-4 py-2">Area of Study</th>
                <th class="border px-4 py-2">Specialisation</th>
                <th class="border px-4 py-2">Course</th>
                <th class="border px-4 py-2">Award</th>
                <th class="border px-4 py-2">Grade</th>
                <th class="border px-4 py-2">Certificate No</th>
                <th class="border px-4 py-2">Start Date</th>
                <th class="border px-4 py-2">End Date</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="border px-4 py-2" x-text="professionalInfo.id"></td>
                <td class="border px-4 py-2" x-text="professionalInfo.user_id"></td>
                <td class="border px-4 py-2" x-text="professionalInfo.institution_name"></td>
                <td class="border px-4 py-2" x-text="professionalInfo.admission_no"></td>
                <td class="border px-4 py-2" x-text="professionalInfo.area_of_study"></td>
                <td class="border px-4 py-2" x-text="professionalInfo.specialisation"></td>
                <td class="border px-4 py-2" x-text="professionalInfo.course"></td>
                <td class="border px-4 py-2" x-text="professionalInfo.award"></td>
                <td class="border px-4 py-2" x-text="professionalInfo.grade"></td>
                <td class="border px-4 py-2" x-text="professionalInfo.certificate_no"></td>
                <td class="border px-4 py-2" x-text="professionalInfo.start_date"></td>
                <td class="border px-4 py-2" x-text="professionalInfo.end_date"></td>
            </tr>
        </tbody>
    </table>
</div>


                               <!-- Relevant Courses Section -->
<div x-data="{ open: false, relevantCourses: [] }" x-init="
    // Simulating data retrieval
    relevantCourses = [
        {
            id: 1,
            user_id: 11,
            institution_name: 'Schumm, Senger and Rempel',
            course: 'Bachelor of Science in Nursing',
            certificate_no: '61881598',
            issue_date: '1970-06-15'
        }
    ];
">
    <h4 @click="open = !open" class="text-md font-semibold cursor-pointer">Relevant Courses</h4>
    <table x-show="open" class="table-auto mt-1 ml-4 border-collapse w-full">
        <thead>
            <tr>
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">User ID</th>
                <th class="border px-4 py-2">Institution Name</th>
                <th class="border px-4 py-2">Course</th>
                <th class="border px-4 py-2">Certificate No</th>
                <th class="border px-4 py-2">Issue Date</th>
            </tr>
        </thead>
        <tbody>
            <template x-for="course in relevantCourses" :key="course.id">
                <tr>
                    <td class="border px-4 py-2" x-text="course.id"></td>
                    <td class="border px-4 py-2" x-text="course.user_id"></td>
                    <td class="border px-4 py-2" x-text="course.institution_name"></td>
                    <td class="border px-4 py-2" x-text="course.course"></td>
                    <td class="border px-4 py-2" x-text="course.certificate_no"></td>
                    <td class="border px-4 py-2" x-text="course.issue_date"></td>
                </tr>
            </template>
        </tbody>
    </table>
</div>


                                <!-- Attachment Info Section -->
                                <div x-data="{ open: false }">
                                    <h4 @click="open = !open" class="text-md font-semibold cursor-pointer">Attachment Info</h4>
                                    <div x-show="open" class="mt-1 ml-4">
                                        @foreach($application->user->attachmentInfo as $attachment)
                                            <p class="flex pair">
                                                <span class="font-semibold">{{ $attachment->document_name }}:</span>
                                                <a href="{{ asset('storage/' . $attachment->file_path) }}" class="ml-2 text-blue-500 hover:underline" target="_blank">View Document</a>
                                            </p>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Status Selection for this User -->
                                <div class="mb-4">
                                    <label for="status-{{ $application->user->id }}" class="block text-sm font-medium text-gray-700">Change Job Status</label>
                                    <select name="status[{{ $application->user->id }}]" id="status-{{ $application->user->id }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                        <option value="Processing" {{ $application->job_status === 'Processing' ? 'selected' : '' }}>Processing of Applications in progress</option>
                                        <option value="Selected" {{ $application->job_status === 'Selected' ? 'selected' : '' }}>Selected for interview</option>
                                        <option value="Appointed" {{ $application->job_status === 'Appointed' ? 'selected' : '' }}>Appointed</option>
                                        <option value="Rejected" {{ $application->job_status === 'Rejected' ? 'selected' : '' }}>Not Successful</option>
                                    </select>
                                </div>

                                <!-- Remarks for this User -->
                                <div class="mb-4">
                                    <label for="remarks-{{ $application->user->id }}" class="block text-sm font-medium text-gray-700">Remarks</label>
                                    <textarea name="remarks[{{ $application->user->id }}]" id="remarks-{{ $application->user->id }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ $application->remarks }}</textarea>
                                </div>

                                <!-- Submit Button for this User -->
                                <div class="mb-4">
                                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-500 hover:bg-blue-600">Update</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination Links -->
                <div class="mt-4">
                    {{ $applications->links() }}
                </div>
            </form>
        </div>
    </div>
</x-layout>
