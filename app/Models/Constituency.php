<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Constituency extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'homecounty_id','added_by_user'];

    public function homecounty()
    {
        return $this->belongsTo(HomeCounty::class);
    }
    public function subcounties()
    {
        return $this->hasMany(Subcounty::class);
    }
    public function user()
{
    return $this->belongsTo(User::class);
}
}
