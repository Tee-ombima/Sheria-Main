<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostPupillage extends Model
{
    protected $fillable = [
        'user_id',
        'vacancy_no',
        'full_name',
        'date_of_birth',
        'identity_card_number',
        'gender',
        'kra_pin',
        'nhif_card_number',
        'postal_address',
        'postal_code',
        'town',
        'email_address',
        'mobile_number',
        'home_county',
        'sub_county',
        'ethnicity',
        'disability_status',
        'nature_of_disability',
        'deployment_region',
        'declaration',
        'status',
        'remarks',
    ];
    
    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
