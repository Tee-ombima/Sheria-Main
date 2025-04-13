<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB; // Add this import
use Illuminate\Support\Facades\Cache;

class InternshipApplication extends Model
{
    use HasFactory;
    use SoftDeletes;


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
        'deleted_by_admin',
        'department_id', // Make sure this is included


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
    // In InternshipApplication model
    // app/Models/InternshipApplication.php

}
