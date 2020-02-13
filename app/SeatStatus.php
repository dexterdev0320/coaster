<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeatStatus extends Model
{
    protected $guarded = [];

    public function getStatusAttribute($attribute)
    {
        if($attribute == 0){
            return 'Occupied';
        }elseif($attribute == 1){
            return 'Available';
        }else{
            return 'TBD';
        }
    }

    public function employee()
    {
        return $this->belongsTo('App\Employee', 'emp_id', 'id');
    }

    public function destination()
    {
        return $this->belongsTo('App\Destination', 'dest_id', 'id');
    }
}
