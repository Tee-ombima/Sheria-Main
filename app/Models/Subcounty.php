<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcounty extends Model
{
    use HasFactory;   
    protected $fillable = ['name', 'constituency_id','added_by_user'];

    public function constituency()
    {
        return $this->belongsTo(Constituency::class);
    }
    public function user()
{
    return $this->belongsTo(User::class);
}
}
