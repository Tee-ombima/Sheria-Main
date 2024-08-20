<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelevantCourses extends Model
{
    use HasFactory;
    protected $fillable = [
        'rel_institution_name', 'rel_course', 'rel_certificate_no', 
        'rel_issue_date', 'user_id'
    ];
}
