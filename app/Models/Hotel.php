<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hotel extends Model
{
    use HasFactory;
    use SoftDeletes;


     /**
     * Get the hotel room types for the hotels.
     */
    public function roomType()
    {
        return $this->hasMany('App\Models\RoomType');
    }

    public function policy()
    {
        return $this->hasMany('App\Models\Policy');
    }

    public function nearByPlace()
    {
        return $this->hasMany('App\Models\NearByPlace');
    }
    public function resortFacility()
    {
        return $this->hasMany('App\Models\ResortFacility');
    }

}
