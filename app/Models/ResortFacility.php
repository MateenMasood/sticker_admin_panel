<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResortFacility extends Model
{
    use HasFactory;

    public function resortFacilityFile()
    {
        return $this->hasMany('App\Models\ResortFacilityFile');
    }

    public function hotel()
    {
        return $this->belongsTo('App\Models\Hotel');
    }
}
