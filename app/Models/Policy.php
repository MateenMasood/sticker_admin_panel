<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Policy extends Model
{
    use HasFactory;
    use SoftDeletes;


    public function hotel()
    {
        return $this->belongsTo('App\Models\Hotel');
    }
}
