<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderImage extends Model
{
    use HasFactory;

    public function Slider()
    {
        return $this->belongsTo('App\Models\Slider');
    }
}
