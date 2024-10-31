<?php

// app/Mail/UserAssignedToDepartmentMail.php

namespace App\Mail;

use App\Models\User;
use App\Models\Department;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\InternshipApplication;

class UserAssignedToDepartmentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $department;
    public $application;

    public function __construct(User $user, Department $department, InternshipApplication $application)
    {
        $this->user = $user;
        $this->department = $department;
        $this->application = $application;
    }

    public function build()
    {
        // Generate the application URL
        $applicationUrl = route('admin.internships.show', $this->application->id);

        return $this->subject('New User Assigned to Your Department')
                    ->view('emails.user_assigned_to_department')
                    ->with('applicationUrl', $applicationUrl);
    }
}