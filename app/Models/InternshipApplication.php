<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternshipApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        
        'full_name',
        'phone',
        'institution',
        'email',
        'id_file',
        'university_letter',
        'application_letter',
        'insurance',
        'good_conduct',
        'cv',
        'status',
    ];

    // Status Constants
    const STATUS_PENDING = 'Pending';
    const STATUS_ACCEPTED = 'Accepted';
    const STATUS_NOT_SUCCESSFUL = 'Not_Successful';

    /**
     * Get the user that owns the internship application.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the department that the internship application is for.
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
