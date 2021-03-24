<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Show extends Model
{

    protected $fillable = [
        'name', 'overview',
        'first_air_date',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }
    public function actors()
    {
        return $this->belongsToMany(Actor::class);
    }
    public function seasons()
    {
        return $this->hasMany(Season::class);
    }
}
