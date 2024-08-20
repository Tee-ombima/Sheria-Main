<!DOCTYPE html>
<html>
<head>
    <title>Job Application Reports</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h1 class="text-center font-bold">Job Application Reports</h1>
    <table class="min-w-full bg-white border border-gray-200">
        <thead>
            <tr>
                <th class="px-4 py-2 border-b">Job Title</th>
                <th class="px-4 py-2 border-b">ID Number</th>
                <th class="px-4 py-2 border-b">Name</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach($reports as $report)
                <tr>
                    <td class="px-4 py-2 border-b">{{ $report->job_title }}</td>
                    <td class="px-4 py-2 border-b">{{ $report->idno }}</td>
                    <td class="px-4 py-2 border-b">{{ $report->name }}</td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
