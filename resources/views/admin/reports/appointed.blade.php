<x-layout>
    <h1 class="text-3xl font-bold mb-6">Appointed</h1>
<form method="GET" action="{{ url()->current() }}" class="mb-4">
    <label for="job_title" class="mr-2">Filter by Job Title:</label>
    <select name="job_title" id="job_title" class="p-2 border rounded">
        <option value="">All Jobs</option>
        @foreach($jobs as $job)
            <option value="{{ $job->title }}" {{ request('job_title') == $job->title ? 'selected' : '' }}>
                {{ $job->title }}
            </option>
        @endforeach
    </select>
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 ml-2 rounded">Filter</button>
</form>

    <table class="table-auto w-full text-left border-collapse">
        <thead>
            <tr>
                <th class="border-b p-4">ID Number</th>
                <th class="border-b p-4">Name</th>
                <th class="border-b p-4">Email</th>
                <th class="border-b p-4">Mobile Number</th>
                <th class="border-b p-4">Alternate Contact</th>
            </tr>
        </thead>
        <tbody>
            @foreach($applications as $application)
                <tr>
                    <td class="border-b p-4">{{ $application->user->personalInfo->idno }}</td>
                    <td class="border-b p-4">{{ $application->user->personalInfo->firstname }} {{ $application->user->personalInfo->lastname }}</td>
                    <td class="border-b p-4">{{ $application->user->email }}</td>
                    <td class="border-b p-4">{{ $application->user->personalInfo->mobile_num }}</td>
                    <td class="border-b p-4">{{ $application->user->personalInfo->alt_contact_person }}: {{ $application->user->personalInfo->alt_contact_telephone_num }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Button to export to CSV -->
    <a href="{{ route('export.csv', ['type' => 'appointed', 'job_title' => $jobTitle]) }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded">Export as CSV</a>

    <!-- Button to download PDF -->
    <a href="{{ route('export.pdf', ['type' => 'appointed', 'job_title' => $jobTitle]) }}" class="mt-4 inline-block bg-red-500 text-white px-4 py-2 rounded">Download PDF</a>
</x-layout>
