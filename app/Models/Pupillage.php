<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pupillage extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'user_id',

        // Personal Details
        'full_name',
        'date_of_birth',
        'identity_card_number',
        'gender',
        'nationality',
        'ethnicity',
        'home_county',
        'sub_county',
        'disability_status',
        'nature_of_disability',

        // Contact Details
        'postal_address',
        'postal_code',
        'town',
        'physical_address',
        'mobile_number',
        'alternate_mobile_number',
        'email_address',

        // Academic Qualification
        'ksce_grade',
        'institution_name',
        'institution_grade',
        
        'other_ksce_grade',
        'other_institution_name',
        'other_institution_grade',
        
        'declaration',
        'are_you_employed',
        'employer_institution_name',
        'gross_salary',

        'status',
    ];
    // In your Pupillage model
protected $casts = [
    'declaration' => 'boolean',
    'disability_status' => 'boolean',
    'are_you_employed' => 'boolean'
];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

   
}
