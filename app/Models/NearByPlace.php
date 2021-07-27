<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NearByPlace extends Model
{
    use HasFactory;

    public function hotel()
    {
        return $this->belongsTo('App\Models\hotel');
    }

    public function nearByPlaceFile()
    {
        return $this->hasMany('App\Models\NearByPlaceFile');
    }
}
