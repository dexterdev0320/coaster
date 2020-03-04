<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeStatus extends Model
{
    protected $table = 'employees_status';
    protected $guarded = [];

    public function employee()
    {
        return $this->belongsTo('App\Employee', 'emp_id', 'id');
    }
}
