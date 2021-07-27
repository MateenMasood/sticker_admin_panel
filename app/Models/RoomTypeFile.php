<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class RoomTypeFile extends Model
{
    use HasFactory;
    use SoftDeletes;


    public function roomType()
    {
        return $this->belongsTo('App\Models\RoomType');
    }
}
