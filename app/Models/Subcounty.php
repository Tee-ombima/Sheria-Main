<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcounty extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'homecounty_id', 'constituency_id'];

    public function homecounty()
    {
        return $this->belongsTo(Homecounty::class);
    }

    public function constituency()
    {
        return $this->belongsTo(Constituency::class);
    }
}
