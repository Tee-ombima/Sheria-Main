<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homecounty extends Model
{
    use HasFactory;
    protected $fillable = ['name','added_by_user'];

    public function constituencies()
    {
        return $this->hasMany(Constituency::class);
    }
    public function user()
{
    return $this->belongsTo(User::class);
}
}
