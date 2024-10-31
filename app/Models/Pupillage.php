<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pupillage extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        
        'full_name',
        'phone',
        'institution',
        'email',
        'id_file',
        'university_letter',
        'kra_pin',
        'insurance',
        'good_conduct',
        'cv',
        'status',
        'remarks',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
