<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'surname', 'firstname', 'lastname', 'salutation', 'dob', 'idno', 
        'kra_pin', 'gender', 'nationality', 'ethnicity', 'homecounty', 
        'subcounty', 'constituency', 'postal_address', 'code', 'town_city', 
        'telephone_num', 'mobile_num', 'email_address', 'alt_contact_person', 
        'alt_contact_telephone_num', 'disability_question', 'nature_of_disability', 
        'ncpd_registration_no', 'ministry', 'station', 'personal_employment_number', 
        'present_substantive_post', 'job_grp_scale_grade', 'date_of_current_appointment', 
        'upgraded_post', 'effective_date_previous_appointment', 'on_secondment_organization', 
        'designation', 'job_group', 'terms_of_service', 'user_id'
    ];

    public function user()
{
    return $this->belongsTo(User::class);
}

}
