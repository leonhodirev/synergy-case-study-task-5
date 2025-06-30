<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['travel_id', 'path'];

    public function travel()
    {
        return $this->belongsTo(Travel::class);
    }
}
