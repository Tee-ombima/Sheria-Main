<!-- resources/views/admin/pupillages/show.blade.php -->
<x-layout>
    <x-card class="p-10 max-w-full mx-auto mt-24 bg-white rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold mb-6">Pupillage Application Details</h1>

        <div class="bg-white shadow-md rounded-lg mb-6">
            <div class="p-4">
                <!-- Applicant Information -->
                <p><strong>Full Name:</strong> {{ $application->full_name }}</p>
                <p><strong>Email:</strong> {{ $application->email }}</p>
                <p><strong>Phone Number:</strong> {{ $application->phone }}</p>
                <p><strong>Address:</strong> {{ $application->address }}</p>
                <p><strong>Institution Name:</strong> {{ $application->institution }}</p>
                <p><strong>Graduation Date:</strong> {{ $application->graduation_date }}</p>
                <p><strong>Degree:</strong> {{ $application->degree }}</p>
                <p><strong>Gender:</strong> {{ $application->gender }}</p>
                <p><strong>Date of Birth:</strong> {{ $application->date_of_birth }}</p>
                <p><strong>Nationality:</strong> {{ $application->nationality }}</p>
                <!-- Add any other fields specific to the pupillage application -->

                <!-- Uploaded Documents -->
                <h3 class="text-xl font-semibold mt-6 mb-4">Uploaded Documents</h3>
                <ul class="list-disc ml-6">
                    <li>
                        <strong>ID File:</strong>
                        @if($application->id_file)
                            <a href="{{ asset('storage/' . $application->id_file) }}" target="_blank" class="text-blue-600">View Document</a>
                        @else
                            Not Provided
                        @endif
                    </li>
                    <li>
                        <strong>University Certificate:</strong>
                        @if($application->university_certificate)
                            <a href="{{ asset('storage/' . $application->university_certificate) }}" target="_blank" class="text-blue-600">View Document</a>
                        @else
                            Not Provided
                        @endif
                    </li>
                    <li>
                        <strong>Own Application Letter:</strong>
                        @if($application->kra_pin)
                            <a href="{{ asset('storage/' . $application->kra_pin) }}" target="_blank" class="text-blue-600">View Document</a>
                        @else
                            Not Provided
                        @endif
                    </li>
                    <li>
                        <strong>Good Conduct Certificate:</strong>
                        @if($application->good_conduct)
                            <a href="{{ asset('storage/' . $application->good_conduct) }}" target="_blank" class="text-blue-600">View Document</a>
                        @else
                            Not Provided
                        @endif
                    </li>
                    <li>
                        <strong>CV:</strong>
                        @if($application->cv)
                            <a href="{{ asset('storage/' . $application->cv) }}" target="_blank" class="text-blue-600">View Document</a>
                        @else
                            Not Provided
                        @endif
                    </li>
                    <!-- Include any other documents specific to the application -->
                </ul>

                <!-- View Department Button -->
                @if($application->department)
                    <div class="mt-6">
                        <a href="{{ route('admin.departments.show', $application->department->id) }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow">
                            View Department
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Form to Update Application -->
        <div class="bg-white shadow-md rounded-lg mb-6">
            <div class="p-4">
                <form action="{{ route('admin.pupillages.update', $application->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="mb-4">
                        <label for="status" class="block text-sm font-medium text-gray-700">Application Status</label>
                        <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="Pending" @if($application->status == 'Pending') selected @endif>Pending</option>
                            <option value="Accepted" @if($application->status == 'Accepted') selected @endif>Accepted</option>
                            <option value="Not_Successful" @if($application->status == 'Not_Successful') selected @endif>Not Successful</option>
                            <option value="Removed" @if($application->status == 'Removed') selected @endif>Removed</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="department_id" class="block text-sm font-medium text-gray-700">Assign to Department</label>
                        <select name="department_id" id="department_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">-- Select Department --</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}" @if($application->department_id == $department->id) selected @endif>
                                    {{ $department->name }} ({{ $department->email }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg shadow">
                            Update Application
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </x-card>
</x-layout>
