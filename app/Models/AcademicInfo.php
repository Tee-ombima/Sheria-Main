<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicInfo extends Model
{
    use HasFactory;
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
