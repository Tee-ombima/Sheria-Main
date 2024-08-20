<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcounty extends Model
{
    use HasFactory;

    protected $fillable = ['homecounty_id', 'name'];

    public function homecounty()
    {
        return $this->belongsTo(HomeCounty::class);
    }
}
