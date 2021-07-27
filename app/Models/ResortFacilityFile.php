<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResortFacilityFile extends Model
{
    use HasFactory;

    public function resortFacility()
    {
        return $this->belongsTo("App\Models\ResortFacility");
    }
}
