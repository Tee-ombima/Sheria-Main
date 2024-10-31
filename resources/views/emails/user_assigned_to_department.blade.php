<!DOCTYPE html>
<html>
<head>
    <title>New User Assigned</title>
</head>
<body>
    <p>Dear {{ $department->name }},</p>

    <p>A new user has been assigned to your department:</p>

    <p><strong>Name:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>

    <p>You can view the application details here:</p>
    <p><a href="{{ $applicationUrl }}">{{ $applicationUrl }}</a></p>

    <p>Please take the necessary actions.</p>

    <p>Best regards,<br>Your Application System</p>
</body>
</html>
