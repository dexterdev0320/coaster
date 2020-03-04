<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HRISEmployee extends Model
{
    protected $connection = 'sqlsrv2';
    protected $table = 'Coaster_vw_Employees';
}
