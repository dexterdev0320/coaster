<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $guarded = [];

    public function status()
    {
        return $this->hasOne('App\EmployeeStatus');
    }

    public function booking()
    {
        return $this->hasOne('App\Booking');
    }

    public function feedback()
    {
        return $this->hasMany('App\Feedback');
    }

    public function seat()
    {
        return $this->hasOne('App\SeatStatus');
    }
}
