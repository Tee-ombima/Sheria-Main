<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCountypp extends Model
{
    use HasFactory;

    protected $fillable = ['county_id', 'name'];

    public function county()
    {
        return $this->belongsTo(Countypp::class);
    }
}
