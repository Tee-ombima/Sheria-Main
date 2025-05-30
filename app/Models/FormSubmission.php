<?php
// app/Models/FormSubmission.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormSubmission extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'form_name', 'is_submitted'];
}

