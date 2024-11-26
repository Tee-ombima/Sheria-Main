<?php

// app/Models/ApplicationSetting.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationSetting extends Model
{
    protected $fillable = [
        'internship_applications_enabled',
        'pupillage_applications_enabled',
        'post_pupillage_applications_enabled',
    ];
}

