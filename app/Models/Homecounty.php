<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homecounty extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    public function subcounties()
    {
        return $this->hasMany(Subcounty::class);
    }
    public function constituencies()
    {
        return $this->hasMany(Constituency::class);
    }
}
