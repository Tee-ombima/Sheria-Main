<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Countyp extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function subCounties()
    {
        return $this->hasMany(SubCountyp::class);
    }
}
