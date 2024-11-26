<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Listing extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'job_reference_number',
        'deadline',
        'vacancies',  // Add this field
        'file',
        
    ];
    
    public function applications()
    {
        return $this->hasMany(Application::class, 'job_id');
    }

    // Automatically cast 'deadline' to a Carbon instance
    protected $dates = ['deadline'];

    /**
     * Accessor to determine if a listing is active.
     *
     * A listing is active if it is not archived and the deadline has not passed.
     */
    public function getIsActiveAttribute()
    {
        return !$this->archived && $this->deadline->isFuture();
    }

    /**
     * Scope to get only active listings.
     *
     * Use in queries to filter listings that are not archived and have not passed their deadline.
     */
    public function scopeActive($query)
    {
        return $query->where('archived', false)
                     ->where('deadline', '>', Carbon::now());
    }

    public function scopeFilter($query, array $filters) {
        if($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%');
        }
    }
}

