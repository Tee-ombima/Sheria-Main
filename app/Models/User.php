<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    use LogsActivity, CausesActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'email', 'role', 'permissions'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn(string $eventName) => "User {$eventName}");
    }
    protected $fillable = [
        'name', 'email', 'password', 'role', 'permissions'
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'permissions' => 'array',
    ];

    public function hasPermission(string $permission): bool
    {
        return in_array($permission, $this->permissions ?? []);
    }

    public function hasAnyPermission(array $permissions): bool
    {
        return count(array_intersect($permissions, $this->permissions ?? [])) > 0;
    }

    public function isSuperAdmin()
    {
        return $this->role === 'superadmin';
    }

    public function listings()
    {
        return $this->hasMany(Listing::class);
    }

    // Add this relationship
    public function applications()
    {
        return $this->hasMany(Application::class, 'user_id');
    }

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