<x-layout>
    <x-card class="p-10 max-w-6xl mx-auto mt-24">

    <h1 class="text-3xl font-bold mb-6">{{ $listing->title }}</h1>

    <!-- Filter Form -->
<form method="GET" action="{{ route('admin.show', ['job' => $listing->id]) }}" class="mb-6">
    <div class="flex flex-wrap items-center bg-gray-100 p-4 rounded-lg shadow-md">
        <!-- ID Number Filter -->
        <div class="w-full md:w-1/2 px-2 mb-4 md:mb-0">
            <label for="filter_idno" class="block text-sm font-medium text-gray-700">Filter by ID Number</label>
            <input type="text" name="filter_idno" id="filter_idno" value="{{ request('filter_idno') }}" class="mt-1 block w-full border border-gray-400 bg-white text-black rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
        </div>
        <!-- Email Filter -->
        <div class="w-full md:w-1/2 px-2 mb-4 md:mb-0">
            <label for="filter_email" class="block text-sm font-medium text-gray-700">Search by Email</label>
            <input type="text" name="filter_email" id="filter_email" value="{{ request('filter_email') }}" class="mt-1 block w-full border border-gray-400 bg-white text-black rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
        </div>
        <!-- Submit and Clear Buttons -->
        <div class="w-full px-2 mt-4 flex items-center">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow mr-2">
                Filter
            </button>
            <a href="{{ route('admin.show', ['job' => $listing->id]) }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg shadow">
                Clear Filter
            </a>
        </div>
    </div>
</form>


    <div class="bg-white shadow-md rounded-lg mb-6">
        <div class="p-4">
            <h2 class="text-2xl font-semibold mb-4 text-center">Manage Applications</h2>

            <!-- Total Emails Count and Status Counts -->
            <div class="mb-4 flex justify-between items-center">
                <p><strong>Total Emails:</strong> <span id="total-emails">{{ $applications->total() }}</span></p>
                <div class="flex space-x-4">
                    <p><strong>Processing:</strong> <span id="processing-count">{{ $processingCount }}</span></p>
                    <p><strong>Selected:</strong> <span id="selected-count" style="color: #fbae1b;">{{ $selectedCount }}</span></p>
                    <p><strong>Appointed:</strong> <span id="appointed-count" style="color: green;">{{ $appointedCount }}</span></p>
                    <p><strong>Not Successful:</strong> <span id="rejected-count" style="color: red;">{{ $rejectedCount }}</span></p>
                    <p><strong>Sum:</strong> <span id="sum-count">{{ $sumCount }}</span></p>
                </div>
            </div>

            <!-- Applications Container -->
            <div class="mb-4" id="applications-container">
                @foreach($applications as $application)
                    <div class="border-b border-red-700 py-2" x-data="{ open: false }">
                        <h3 @click="open = !open" class="text-lg font-medium cursor-pointer">{{ $application->user->email }}</h3>
                        <div x-show="open" class="mt-2">
                            <h4 class="text-2xl font-semibold mb-4 text-blue-600 text-center">Personal Info</h4>

                            <!-- Personal Info -->
                            <div class="mb-6">
                                <div class="grid grid-cols-3 gap-4">
                                    <!-- Name Fields -->
                                    <div><strong>Salutation:</strong> {{ $application->user->personalInfo->salutation ?? 'N/A' }}</div>
                                    <div><strong>Surname:</strong> {{ $application->user->personalInfo->surname ?? 'N/A' }}</div>
                                    <div><strong>First Name:</strong> {{ $application->user->personalInfo->firstname ?? 'N/A' }}</div>
                                    <div><strong>Last Name:</strong> {{ $application->user->personalInfo->lastname ?? 'N/A' }}</div>

                                    <!-- Contact Information -->
                                    <div><strong>Email Address:</strong> {{ $application->user->personalInfo->email_address ?? 'N/A' }}</div>
                                    <div><strong>Mobile Number:</strong> {{ $application->user->personalInfo->mobile_num ?? 'N/A' }}</div>
                                    <div><strong>Telephone Number:</strong> {{ $application->user->personalInfo->telephone_num ?? 'N/A' }}</div>
                                    <div><strong>Alternate Contact Person:</strong> {{ $application->user->personalInfo->alt_contact_person ?? 'N/A' }}</div>
                                    <div><strong>Alternate Contact Telephone:</strong> {{ $application->user->personalInfo->alt_contact_telephone_num ?? 'N/A' }}</div>

                                    <!-- Personal Details -->
                                    <div><strong>ID Number:</strong> {{ $application->user->personalInfo->idno ?? 'N/A' }}</div>
                                    <div><strong>KRA PIN:</strong> {{ $application->user->personalInfo->kra_pin ?? 'N/A' }}</div>
                                    <div><strong>Date of Birth:</strong> {{ $application->user->personalInfo->dob ? \Carbon\Carbon::parse($application->user->personalInfo->dob)->format('d M Y') : 'N/A' }}</div>
                                    <div><strong>Gender:</strong> {{ ucfirst($application->user->personalInfo->gender ?? 'N/A') }}</div>
                                    <div><strong>Nationality:</strong> {{ $application->user->personalInfo->nationality ?? 'N/A' }}</div>
                                    <div><strong>Ethnicity:</strong> {{ $application->user->personalInfo->ethnicity ?? 'N/A' }}</div>
                                    <div><strong>Disability:</strong> {{ $application->user->personalInfo->disability_question ?? 'N/A' }}</div>
                                    <div><strong>Nature of Disability:</strong> {{ $application->user->personalInfo->nature_of_disability ?? 'N/A' }}</div>
                                    <div><strong>NCPD Registration No:</strong> {{ $application->user->personalInfo->ncpd_registration_no ?? 'N/A' }}</div>

                                    <!-- Address Information -->
                                    <div><strong>Postal Address:</strong> {{ $application->user->personalInfo->postal_address ?? 'N/A' }}</div>
                                    <div><strong>Postal Code:</strong> {{ $application->user->personalInfo->code ?? 'N/A' }}</div>
                                    <div><strong>Town/City:</strong> {{ $application->user->personalInfo->town_city ?? 'N/A' }}</div>

                                    <!-- Location Information -->
                                    <div><strong>Home County:</strong> {{ optional($application->user->personalInfo->homeCounty)->name ?? 'N/A' }}</div>
                                    <div><strong>Constituency:</strong> {{ optional($application->user->personalInfo->constituency)->name ?? 'N/A' }}</div>
                                    <div><strong>Subcounty:</strong> {{ optional($application->user->personalInfo->subcounty)->name ?? 'N/A' }}</div>

                                    <!-- Employment Information -->
                                    <div><strong>Ministry:</strong> {{ $application->user->personalInfo->ministry ?? 'N/A' }}</div>
                                    <div><strong>Station:</strong> {{ $application->user->personalInfo->station ?? 'N/A' }}</div>
                                    <div><strong>Personal Employment Number:</strong> {{ $application->user->personalInfo->personal_employment_number ?? 'N/A' }}</div>
                                    <div><strong>Present Substantive Post:</strong> {{ $application->user->personalInfo->present_substantive_post ?? 'N/A' }}</div>
                                    <div><strong>Job Group/Scale Grade:</strong> {{ $application->user->personalInfo->job_grp_scale_grade ?? 'N/A' }}</div>
                                    <div><strong>Date of Current Appointment:</strong> {{ $application->user->personalInfo->date_of_current_appointment ? \Carbon\Carbon::parse($application->user->personalInfo->date_of_current_appointment)->format('d M Y') : 'N/A' }}</div>
                                    <div><strong>Upgraded Post:</strong> {{ $application->user->personalInfo->upgraded_post ?? 'N/A' }}</div>
                                    <div><strong>Effective Date of Previous Appointment:</strong> {{ $application->user->personalInfo->effective_date_previous_appointment ? \Carbon\Carbon::parse($application->user->personalInfo->effective_date_previous_appointment)->format('d M Y') : 'N/A' }}</div>
                                    <div><strong>On Secondment Organization:</strong> {{ $application->user->personalInfo->on_secondment_organization ?? 'N/A' }}</div>
                                    <div><strong>Designation:</strong> {{ $application->user->personalInfo->designation ?? 'N/A' }}</div>
                                    <div><strong>Job Group:</strong> {{ $application->user->personalInfo->job_group ?? 'N/A' }}</div>
                                    <div><strong>Terms of Service:</strong> {{ $application->user->personalInfo->terms_of_service ?? 'N/A' }}</div>
                                </div>
                            </div>

                            <!-- Academic Info -->
                            <div class="mt-2">
                                <h4 class="text-2xl font-semibold mb-4 text-blue-600 text-center">Academic Info</h4>
                                @foreach($application->user->academicInfo as $info)
                                    <div class="border-b border-red-700 py-2">
                                        <div class="grid grid-cols-2 gap-4">
                                            @foreach($info->toArray() as $key => $value)
                                                @if(!is_null($value))
                                                    <div><strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong> {{ $value }}</div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Professional Info -->
                            <div class="mt-2">
                                <h4 class="text-2xl font-semibold mb-4 text-blue-600 text-center">Professional Info</h4>
                                @foreach($application->user->profInfo as $info)
                                    <div class="border-b border-red-700 py-2">
                                        <div class="grid grid-cols-2 gap-4">
                                            @foreach($info->toArray() as $key => $value)
                                                @if(!is_null($value))
                                                    <div><strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong> {{ $value }}</div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Relevant Courses -->
                            <div class="mt-2">
                                <h4 class="text-2xl font-semibold mb-4 text-blue-600 text-center">Relevant Courses</h4>
                                @foreach($application->user->relevantCourses as $course)
                                    <div class="border-b border-red-700 py-2">
                                        <div class="grid grid-cols-2 gap-4">
                                            @foreach($course->toArray() as $key => $value)
                                                @if(!is_null($value))
                                                    <div><strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong> {{ $value }}</div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Attachments -->
                            <div class="mt-4">
                                <h4 class="text-2xl font-semibold mb-4 text-blue-600 text-center">Attachments</h4>
                                @foreach($application->user->attachmentInfo as $attachment)
                                    <div class="border-b border-red-700 py-2">
                                        <p><strong>File Name:</strong> {{ $attachment->file_name }}</p>
                                        <p><strong>File Type:</strong> {{ $attachment->file_type }}</p>
                                        <p><strong>File Size:</strong> {{ $attachment->file_size }} KB</p>
                                        <a href="{{ asset($attachment->file_path) }}" target="_blank" class="text-blue-500 underline">Download</a>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Form to Update Job Status and Remarks -->
                            <form action="{{ route('admin.updateStatus') }}" method="POST" class="mt-4">
                                @csrf
                                <input type="hidden" name="application_id" value="{{ $application->id }}">
                                <div class="mb-4">
                                    <label for="job_status_{{ $application->id }}" class="block text-sm font-medium text-gray-700">Job Status</label>
                                    <select name="job_status" id="job_status_{{ $application->id }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                        <option value="Processing" @if($application->job_status == 'Processing') selected @endif>Processing</option>
                                        <option value="Selected" @if($application->job_status == 'Selected') selected @endif>Selected for Interview</option>
                                        <option value="Appointed" @if($application->job_status == 'Appointed') selected @endif>Appointed</option>
                                        <option value="Not_Successful" @if($application->job_status == 'Not_Successful') selected @endif>Not Successful</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label for="remarks_{{ $application->id }}" class="block text-sm font-medium text-gray-700">Remarks</label>
                                    <textarea name="remarks" id="remarks_{{ $application->id }}" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ $application->remarks }}</textarea>
                                </div>
                                <div class="flex justify-end">
                                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow">
                                        Update Application
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination Links -->
            <div class="mt-4">
                {{ $applications->appends(request()->except('page'))->links() }}
            </div>
        </div>
    </div>
        </x-card>

</x-layout>
