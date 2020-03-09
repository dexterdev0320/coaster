<?php

namespace App\Http\Controllers;

use App\AgusanHRIS;
use App\Employee;
use Exception;
use Illuminate\Http\Request;

class AgusanHRISController extends Controller
{
    public function agusan_employees()
    {
        try{
            $HRISEmployees = AgusanHRIS::all();

            $employees = Employee::where('syncFrom', 'LIKE', '%AGUSAN%')->get();
            $employees = json_decode($employees);

            foreach ($HRISEmployees as $hris) {
                $emp = array_search($hris->emp_id, array_column($employees, 'emp_id'), false);
                
                if($emp === false){
                    Employee::create([
                        'emp_id' => $hris->emp_id,
                        'name' => $hris->name,
                        'address' => $hris->address,
                        'dept' => $hris->dept,
                        'location' => $hris->location,
                        'isactive' => $hris->isactive,
                        'syncFrom' => 'AGUSAN'
                    ]);
                    
                }else{
                    $new_hris = json_decode(json_encode($hris), true);

                    $new_emp = json_decode(json_encode($employees[$emp]), true);

                    foreach ($new_hris as $key_hris => $nhris) {
                        
                        foreach ($new_emp as $key_emp => $nemp) {
                            
                            if($key_hris == $key_emp){
                                $updateEmp = self::checkDetails($nhris == $nemp);
                            }
                            if(isset($updateEmp) && !$updateEmp){
                                break;
                            }
                        }
                        if($updateEmp === FALSE){
                            Employee::where('emp_id', $employees[$emp]->emp_id)
                            ->update([
                                'name' => $hris->name,
                                'address' => $hris->address,
                                'dept' => $hris->dept,
                                'location' => $hris->location,
                                'isactive' => $hris->isactive,
                                'syncFrom' => 'AGUSAN'
                            ]);
                            break;
                        }
                    }
                }            
            }
            return response()->json(['success' => true, 'message' => 'Sync Successfully']);
        }
        catch(Exception $exception){
            return response()->json(['success' => false, 'message' => 'Something went wrong. Please call administrator']);
        }
    }
    public function checkDetails($value)
    {
        if($value === false){
            return FALSE;
        }
        return TRUE;
    }
}
