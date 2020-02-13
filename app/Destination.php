<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $guarded = [];

    public function seat()
    {
        return $this->hasMany('App\SeatStatus');
    }
}
