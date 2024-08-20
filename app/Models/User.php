<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name', 'email', 'password', 'role',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        
    ];
    public function listings()
    {
        return $this->hasMany(Listing::class);
    }
    // app/Models/User.php
public function personalInfo()
{
    return $this->hasOne(PersonalInfo::class);
}

public function academicInfo()
{
    return $this->hasMany(AcademicInfo::class);
}

public function profInfo()
{
    return $this->hasMany(ProfInfo::class);
}

public function relevantCourses()
{
    return $this->hasMany(RelevantCourses::class);
}
public function attachmentInfo()
{
    return $this->hasMany(Attachment::class);
}
    

}
