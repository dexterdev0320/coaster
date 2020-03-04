<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgusanHRIS extends Model
{
    protected $connection = 'sqlsrv3';
    protected $table = 'Coaster_vw_Employees';
}
