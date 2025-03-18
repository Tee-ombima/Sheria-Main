<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcounty extends Model
{
    use HasFactory;   
    protected $fillable = ['name', 'homecounty_id','added_by_user'];

    public function homecounty()
    {
        return $this->belongsTo(Homecounty::class);
    }

    public function constituencies()
    {
        return $this->hasMany(Constituency::class);
    }
    public function user()
{
    return $this->belongsTo(User::class);
}
}
