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
                                    <div x-show="open" class="mt-1 ml-4">
                                        @foreach($application->user->personalInfo->toArray() as $key => $value)
                                            <p class="flex pair"><span class="font-semibold">{{ ucfirst(str_replace('_', ' ', $key)) }}:</span> <span class="ml-2">{{ $value }}</span></p>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Academic Info Section -->
                                <div x-data="{ open: false }">
                                    <h4 @click="open = !open" class="text-md font-semibold cursor-pointer">Academic Info</h4>
                                    <div x-show="open" class="mt-1 ml-4">
                                        @foreach($application->user->academicInfo as $info)
                                            @foreach($info->toArray() as $key => $value)
                                                <p class="flex pair"><span class="font-semibold">{{ ucfirst(str_replace('_', ' ', $key)) }}:</span> <span class="ml-2">{{ $value }}</span></p>
                                            @endforeach
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Professional Info Section -->
                                <div x-data="{ open: false }">
                                    <h4 @click="open = !open" class="text-md font-semibold cursor-pointer">Professional Info</h4>
                                    <div x-show="open" class="mt-1 ml-4">
                                        @foreach($application->user->profInfo as $info)
                                            @foreach($info->toArray() as $key => $value)
                                                <p class="flex pair"><span class="font-semibold">{{ ucfirst(str_replace('_', ' ', $key)) }}:</span> <span class="ml-2">{{ $value }}</span></p>
                                            @endforeach
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Relevant Courses Section -->
                                <div x-data="{ open: false }">
                                    <h4 @click="open = !open" class="text-md font-semibold cursor-pointer">Relevant Courses</h4>
                                    <div x-show="open" class="mt-1 ml-4">
                                        @foreach($application->user->relevantCourses as $course)
                                            @foreach($course->toArray() as $key => $value)
                                                <p class="flex pair"><span class="font-semibold">{{ ucfirst(str_replace('_', ' ', $key)) }}:</span> <span class="ml-2">{{ $value }}</span></p>
                                            @endforeach
                                        @endforeach
                                    </div>
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
