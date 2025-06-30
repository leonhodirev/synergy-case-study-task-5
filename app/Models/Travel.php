<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    protected $fillable = ['title', 'latitude', 'longitude', 'cost', 'user_id'];

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

}
