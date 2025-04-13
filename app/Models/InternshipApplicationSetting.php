<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InternshipApplicationSetting extends Model
{
    protected $table = 'application_settings'; // Keep existing table name

    protected $fillable = [
        'internship_applications_enabled',
        'max_pending_applications'
    ];

    protected $casts = [
        'internship_applications_enabled' => 'boolean'
    ];
}