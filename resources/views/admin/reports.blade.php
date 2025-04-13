<!-- resources/views/admin/reports.blade.php -->

<x-layout>
    <h1 class="text-center font-bold">Job Application Reports</h1>



    <table class="min-w-full bg-white border border-gray-200">
        <thead>
            <tr>
                <th class="px-4 py-2 border-b">Job Title</th>
                <th class="px-4 py-2 border-b">ID Number</th>
                <th class="px-4 py-2 border-b">Name</th>
                <th class="px-4 py-2 border-b">Gender</th>
                <th class="px-4 py-2 border-b">County</th>
                <th class="px-4 py-2 border-b">Subcounty</th>
                <th class="px-4 py-2 border-b">Constituency</th>
                <th class="px-4 py-2 border-b">Email</th>
                <th class="px-4 py-2 border-b">Phone Number</th>
                <th class="px-4 py-2 border-b">Alternate Phone Number</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reports as $report)
                <tr>
                    <td class="px-4 py-2 border-b">{{ $report->job_title }}</td>
                    <td class="px-4 py-2 border-b">{{ $report->idno }}</td>
                    <td class="px-4 py-2 border-b">{{ $report->name }}</td>
                    <td class="px-4 py-2 border-b">{{ $report->gender ?? 'N/A' }}</td>
                    <td class="px-4 py-2 border-b">{{ $report->homecounty->name ?? 'N/A' }}</td>
                    <td class="px-4 py-2 border-b">{{ $report->subcounty->name ?? 'N/A' }}</td>
                    <td class="px-4 py-2 border-b">{{ $report->constituency->name ?? 'N/A' }}</td>
                    <td class="px-4 py-2 border-b">{{ $report->email }}</td>
                    <td class="px-4 py-2 border-b">{{ $report->phone_num }}</td>
                    <td class="px-4 py-2 border-b">{{ $report->altphone_num }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-layout>
