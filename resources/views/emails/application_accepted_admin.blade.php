<!DOCTYPE html>
<html>
<body>
    <p>Hello {{ $adminName }},</p>

    <p>The internship application you assigned has been <strong>accepted</strong> by the department:</p>

    <p><strong>Applicant:</strong> {{ $application->user->name ?? 'N/A' }}</p>
    <p><strong>Department:</strong> {{ $application->department->name ?? 'N/A' }}</p>

    <a href="{{ route('admin.internships.show', $application->id) }}">View Application</a>
</body>
</html>