<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Constituency extends Model
{
    use HasFactory;

    protected $fillable = ['name','subcounty_id','added_by_user'];

    public function subcounty()
    {
        return $this->belongsTo(SubCounty::class);
    }
    
    public function user()
{
    return $this->belongsTo(User::class);
}
}
