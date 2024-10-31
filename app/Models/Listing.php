<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


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

    // ... existing code ...

    /**
     * Determine if the listing is expired based on the deadline.
     *
     * @return bool
     */
    public function getIsExpiredAttribute()
    {
        return $this->deadline <= now();
    }

    // Optionally, add an accessor for 'isActive'
    /**
     * Determine if the listing is active (not archived and not expired).
     *
     * @return bool
     */
    public function getIsActiveAttribute()
    {
        return !$this->archived && !$this->isExpired;
    }

    // Optionally, add a scope for active listings
    /**
     * Scope a query to only include active listings.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('archived', false)
                     ->where('deadline', '>', now());
    }

    public function scopeFilter($query, array $filters) {
        if($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . request('search') . '%');
        }
    }
}

