<x-layout>
    <x-card class="p-10 max-w-full mx-auto mt-24 bg-white rounded-lg shadow-lg">

        <h1 class="text-3xl font-bold mb-6">Application Details</h1>

<div class="bg-white shadow-md rounded-lg mb-6">
    <div class="p-4">
        <h2 class="text-2xl font-semibold mb-4">Applicant Information</h2>
        <p><strong>Full Name:</strong> {{ $application->full_name }}</p>
        <p><strong>Email:</strong> {{ $application->email }}</p>
        <p><strong>Phone Number:</strong> {{ $application->phone }}</p>
        <p><strong>Institution Name:</strong> {{ $application->institution }}</p>

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
                <strong>University Letter:</strong>
                @if($application->university_letter)
                    <a href="{{ asset('storage/' . $application->university_letter) }}" target="_blank" class="text-blue-600">View Document</a>
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
                <strong>Insurance:</strong>
                @if($application->insurance)
                    <a href="{{ asset('storage/' . $application->insurance) }}" target="_blank" class="text-blue-600">View Document</a>
                @else
                    Not Provided
                @endif
            </li>
            <li>
                <strong>Good Conduct:</strong>
                @if($application->good_conduct)
                    <a href="{{ asset('storage/' . $application->good_conduct) }}" target="_blank" class="text-blue-600">View Document</a>
                @else
                    Not Provided
                @endif
            </li>
            <li>
                <strong>Curriculum Vitae (CV):</strong>
                @if($application->cv)
                    <a href="{{ asset('storage/' . $application->cv) }}" target="_blank" class="text-blue-600">View Document</a>
                @else
                    Not Provided
                @endif
            </li>
        </ul>
    </div>
</div>

<div class="bg-white shadow-md rounded-lg mb-6">
    <div class="p-4">
        <form action="{{ route('admin.internships.update', $application->id) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700">Application Status</label>
                <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="Pending" @if($application->status == 'Pending') selected @endif>Pending</option>
                    <option value="Accepted" @if($application->status == 'Accepted') selected @endif>Accepted</option>
                    <option value="Not_Successful" @if($application->status == 'Not_Successful') selected @endif>Not Successful</option>
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

    </x-card>
</x-layout>
