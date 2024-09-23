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
                                <div x-data="{ open: false }">
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
                <td class="border px-4 py-2">1</td>
                <td class="border px-4 py-2">11</td>
                <td class="border px-4 py-2">Default</td>
                <td class="border px-4 py-2">Default</td>
                <td class="border px-4 py-2">2000-01-01</td>
                <td class="border px-4 py-2">00000000</td>
                <td class="border px-4 py-2">DEFA12345</td>
                <td class="border px-4 py-2">Male</td>
                <td class="border px-4 py-2">default@example.com</td>
                <td class="border px-4 py-2">0000000000</td>
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
                <td class="border px-4 py-2">Default</td>
                <td class="border px-4 py-2">Default</td>
                <td class="border px-4 py-2">Default</td>
                <td class="border px-4 py-2">0000000000</td>
                <td class="border px-4 py-2">N/A</td>
                <td class="border px-4 py-2">N/A</td>
                <td class="border px-4 py-2">N/A</td>
                <td class="border px-4 py-2">N/A</td>
                <td class="border px-4 py-2">N/A</td>
                <td class="border px-4 py-2">N/A</td>
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
                <td class="border px-4 py-2">N/A</td>
                <td class="border px-4 py-2">N/A</td>
                <td class="border px-4 py-2">N/A</td>
                <td class="border px-4 py-2">N/A</td>
                <td class="border px-4 py-2">N/A</td>
                <td class="border px-4 py-2">N/A</td>
                <td class="border px-4 py-2">N/A</td>
                <td class="border px-4 py-2">N/A</td>
                <td class="border px-4 py-2">2024-09-22</td>
                <td class="border px-4 py-2">2024-09-22</td>
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
                <td class="border px-4 py-2">N/A</td>
                <td class="border px-4 py-2">N/A</td>
                <td class="border px-4 py-2">N/A</td>
                <td class="border px-4 py-2">Default</td>
                <td class="border px-4 py-2">Default</td>
                <td class="border px-4 py-2">N/A</td>
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
                <th class="border px-4 py-2">Highschool</th>
                <th class="border px-4 py-2">Specialisation</th>
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
            <tr>
                <td class="border px-4 py-2">1</td>
                <td class="border px-4 py-2">11</td>
                <td class="border px-4 py-2">West, Parker and Braun</td>
                <td class="border px-4 py-2">85855495</td>
                <td class="border px-4 py-2">Humanities and Social Sciences</td>
                <td class="border px-4 py-2">Cardiology</td>
                <td class="border px-4 py-2">Bachelor of Business Administration</td>
                <td class="border px-4 py-2">Second Class Honors (Upper Division)</td>
                <td class="border px-4 py-2">Second Class Honors</td>
                <td class="border px-4 py-2">94594707</td>
                <td class="border px-4 py-2">1973-09-21</td>
                <td class="border px-4 py-2">2008-07-03</td>
                <td class="border px-4 py-2">2008-10-02</td>
            </tr>
        </tbody>
    </table>
</div>


                                <!-- Professional Info Section -->
                                <div x-data="{ open: false }">
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
                <td class="border px-4 py-2">1</td>
                <td class="border px-4 py-2">11</td>
                <td class="border px-4 py-2">Reichel, Hilpert and Stracke</td>
                <td class="border px-4 py-2">17317444</td>
                <td class="border px-4 py-2">GeoScience</td>
                <td class="border px-4 py-2">Crop Production</td>
                <td class="border px-4 py-2">Diploma in Information Technology</td>
                <td class="border px-4 py-2">Diploma</td>
                <td class="border px-4 py-2">Distinction</td>
                <td class="border px-4 py-2">10085924</td>
                <td class="border px-4 py-2">1998-10-29</td>
                <td class="border px-4 py-2">2003-10-14</td>
            </tr>
        </tbody>
    </table>
</div>


                                <!-- Relevant Courses Section -->
                                <div x-data="{ open: false }">
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
            <tr>
                <td class="border px-4 py-2">1</td>
                <td class="border px-4 py-2">11</td>
                <td class="border px-4 py-2">Schumm, Senger and Rempel</td>
                <td class="border px-4 py-2">Bachelor of Science in Nursing</td>
                <td class="border px-4 py-2">61881598</td>
                <td class="border px-4 py-2">1970-06-15</td>
            </tr>
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
