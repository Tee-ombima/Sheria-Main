<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use HasFactory;
    use SoftDeletes;

    // Allow mass assignment for the 'name' field
    protected $fillable = ['name','archived'];
    public function applications()
    {
        return $this->hasMany(InternshipApplication::class); // Assuming Attachment is the model for applications
    }
}