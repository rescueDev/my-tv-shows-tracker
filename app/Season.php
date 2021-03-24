<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }

    public function show()
    {
        return $this->belongsTo(Show::class);
    }
}
