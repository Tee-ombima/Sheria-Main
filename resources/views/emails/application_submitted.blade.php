<!DOCTYPE html>
<html>
<head>
    <title>Application Confirmation</title>
</head>
<body>
    <p>Dear {{ $application->name }},</p>

    <p>Thank you for applying for the position of "<strong>{{ $application->job_title }}</strong>" (Ref: {{ $application->job_reference_number }}).</p>

    <p>We have received your application and our team will review it shortly. Please check your "View My Applications" tab for updates.</p>

    <p>We appreciate your interest in joining our team.</p>

    <p>Best regards,<br>OFFICE OF THE ATTORNEY GENERAL</p>
</body>
</html>
