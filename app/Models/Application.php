<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'job_id', 'idno', 'name', 'job_title', 
         'job_reference_number', 'remarks', 'job_status'

    ];

    public function listing()
    {
        return $this->belongsTo(Listing::class, 'job_id'); 
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
