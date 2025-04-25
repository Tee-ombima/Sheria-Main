<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostPupillage extends Model
{
    use SoftDeletes;
    use HasFactory;


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
        'deleted_by_admin'

    ];
    protected $casts = [
        'declaration' => 'boolean',
        'disability_status' => 'boolean',
    ];
    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
