<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NearByPlaceFile extends Model
{
    use HasFactory;

    public function nearByPlace()
    {
        return $this->belongsTo('App\Models\NearByPlace');
    }
}
