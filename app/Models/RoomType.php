<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class RoomType extends Model
{
    use HasFactory;
    use SoftDeletes;


    public function hotel()
    {
        return $this->belongsTo('App\Models\Hotel');
    }

    public function roomTypeFile()
    {
        return $this->hasMany('App\Models\RoomTypeFile');
    }

    public function room()
    {
        return $this->hasMany('App\Models\Room');
    }

    public function roomPolicy()
    {
        return $this->hasMany('App\Models\RoomPolicy');
    }

    // **************** mutator set aminites n upper case ****************** 
    public function setAminitiesAttribute($value)
    {
        $this->attributes['aminities'] = strtoupper($value);
    }
}
