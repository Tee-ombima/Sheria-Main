<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternshipApplication extends Model
{
    use HasFactory;
    public function department()
    {
        return $this->belongsTo(Department::class); // Assuming each Attachment belongs to one department
    }
}
