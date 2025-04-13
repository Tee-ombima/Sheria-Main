<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
class AcademicInfo extends Model
{
    use HasFactory;
    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['user_id'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
    protected $fillable = [
        'institution_name', 'student_admission_no', 'highschool', 
        'specialisation', 'award', 'course', 'grade', 'certificate_no', 
        'start_date', 'end_date', 'graduation_completion_date', 'user_id'
    ];

    public function academicInfo()
{
    return $this->hasOne(academicInfo::class);
}

}
