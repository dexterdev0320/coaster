<?php

namespace App\Http\Controllers;

use App\Employee;
use App\TempEmployee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TempEmployeeController extends Controller
{
    public function sync($location)
    {
        
        if($location == 'davao'){
            $rooms_get = 'http://localhost:8001/employees';
 
            $ch_rooms = curl_init($rooms_get);

            curl_setopt($ch_rooms, CURLOPT_CUSTOMREQUEST, "GET");

            curl_setopt($ch_rooms, CURLOPT_HTTPHEADER, array(
                'Content-type:application/json'
            ));
            curl_setopt($ch_rooms, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch_rooms, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch_rooms, CURLOPT_SSL_VERIFYPEER, 0);
            $result_rooms = curl_exec($ch_rooms);
            $result = json_decode($result_rooms);

            // DB::delete("delete from employees_status
            // where emp_id in (select id from employees where syncFrom like 'davao')
            // and isblacklist = 1");

            // DB::delete("delete from employees
            // where syncFrom like '%davao%'
            // and id not in (select emp_id from employees_status)");

            // foreach($result as $check){
            //     Employee::create([
            //         'emp_id' => $check->EmpID,
            //         'name' => $check->name,
            //         'address' => $check->address,
            //         'dept' => $check->dept,
            //         'location' => $check->location,
            //         'isactive' => $check->isactive,
            //         'syncFrom' => 'Davao'
            //     ]);
            // }
            
        }
    }
}
