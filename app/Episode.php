<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Episode extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'name',
        'overview',
        'first_air_date',
        'episode_number',
        'season_number',
        'image',
        'rating',
        'season_id'
    ];
    public function season()
    {
        return $this->belongsTo(Season::class);
    }
}
