<!-- resources/views/admin/reports.blade.php -->

<x-layout>
    <h1 class="text-center font-bold">Job Application Reports</h1>

        <a href="{{ route('reports.download') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-500 hover:bg-green-600" >Download PDF</a>


    <table class="min-w-full bg-white border border-gray-200">
        <thead>
            <tr>
                <th class="px-4 py-2 border-b">Job Title</th>
                <th class="px-4 py-2 border-b">ID Number</th>
                <th class="px-4 py-2 border-b">Name</th>
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
                    <td class="px-4 py-2 border-b">{{ $report->email }}</td>
                    <td class="px-4 py-2 border-b">{{ $report->phone_num }}</td>
                    <td class="px-4 py-2 border-b">{{ $report->altphone_num }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-layout>
