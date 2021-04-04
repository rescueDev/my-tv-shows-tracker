<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Season extends Model
{

    use SoftDeletes;


    protected $fillable = [
        'name',
        'overview',
        'first_air_date',
        'episode_count',
        'season_number',
        'poster',
        'show_id',
    ];

    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }

    public function show()
    {
        return $this->belongsTo(Show::class );
    }
}
