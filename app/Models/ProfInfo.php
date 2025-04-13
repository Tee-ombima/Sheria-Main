<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
class ProfInfo extends Model
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
        'prof_institution_name', 'prof_student_admission_no', 
        'prof_area_of_study_high_school_level', 'prof_area_of_specialisation', 
        'prof_award', 'prof_course', 'prof_grade', 'prof_certificate_no', 
        'prof_start_date', 'prof_end_date', 'user_id'
    ];
}
