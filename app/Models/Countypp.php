<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Countypp extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function subCounties()
    {
        return $this->hasMany(SubCountypp::class);
    }
}
