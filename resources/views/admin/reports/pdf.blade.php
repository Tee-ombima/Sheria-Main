<x-layout>
    <h1 class="text-3xl font-bold mb-6">{{ ucfirst($type) }} Applications</h1>

    <table class="table-auto w-full text-left border-collapse">
        <thead>
            <tr>
                <th class="border-b p-4">Table Number</th>
                <th class="border-b p-4">ID Number</th>
                <th class="border-b p-4">Name</th>
                <th class="border-b p-4">Email</th>
                <th class="border-b p-4">Mobile Number</th>
                <th class="border-b p-4">Alternate Contact</th>
                <th class="border-b p-4">Job Applied For</th>
            </tr>
        </thead>
        <tbody>
            @foreach($applications as $index => $application)
                <tr>
                    <td class="border-b p-4">{{ $index + 1 }}</td>
                    <td class="border-b p-4">{{ $application->user->personalInfo->idno }}</td>
                    <td class="border-b p-4">{{ $application->user->personalInfo->firstname }} {{ $application->user->personalInfo->lastname }}</td>
                    <td class="border-b p-4">{{ $application->user->email }}</td>
                    <td class="border-b p-4">{{ $application->user->personalInfo->mobile_num }}</td>
                    <td class="border-b p-4">{{ $application->user->personalInfo->alt_contact_person }}: {{ $application->user->personalInfo->alt_contact_telephone_num }}</td>
                    <td class="border-b p-4">{{ $application->listing->title }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-layout>
