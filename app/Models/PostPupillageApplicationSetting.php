<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostPupillageApplicationSetting extends Model
{
    protected $table = 'application_settings'; // Keep existing table name

    protected $fillable = [
        'post_pupillage_applications_enabled',
        'max_postpupillage_applications'
    ];

    protected $casts = [
        'post_pupillage_applications_enabled' => 'boolean'
    ];
}