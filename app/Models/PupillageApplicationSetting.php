<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PupillageApplicationSetting extends Model
{
    protected $table = 'application_settings'; // Keep existing table name

    protected $fillable = [
        'pupillage_applications_enabled',
        'max_pupillage_applications'
    ];

    protected $casts = [
        'pupillage_applications_enabled' => 'boolean'
    ];
}