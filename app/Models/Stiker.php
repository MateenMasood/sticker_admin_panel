<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stiker extends Model
{
    use HasFactory;

    public function pack()
    {
        return $this->belongsTo('App\Models\Pack','category');

    }
}
