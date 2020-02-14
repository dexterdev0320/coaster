<?php

namespace App\Http\Controllers;

use App\Employee;
use App\EmployeePriority;
use App\EmployeeStatus;
use App\Http\Resources\Employee as EmployeeResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index(Request $request)
    {
        if(!empty($request->name)){
            $employees = Employee::where('name', 'LIKE', '%' . $request->name . '%')->paginate(13)->appends(['name' => $request->name]);
                return view('employee.index', compact('employees'));
        }
        $employees = DB::table('employees')
                        ->leftJoin('employee_statuses', 'employees.id', '=', 'employee_statuses.emp_id')
                        ->select(['employees.*', 'employee_statuses.ispriority', 'employee_statuses.isblacklist'])
                        ->paginate(13);
        // dd($employees->all());
        return view('employee.index', compact('employees'));
    }

    public function indexapi(Request $request)
    {
        $employees = DB::select('select 
                                    employees.*, 
                                    employee_statuses.ispriority, 
                                    employee_statuses.isblacklist 
                                    from employees 
                                    left join employee_statuses on employees.id = employee_statuses.emp_id
                                    order by employees.emp_id asc');

        return EmployeeResource::collection($employees);
    }

    public function search(Request $request)
    {
        // dd($request->all());
        // if(!empty($request->name)){
            
        // }
        // $employees = Employee::where('name', 'LIKE', '%'.$request->employee.'%')->paginate(10);

        // return view('employee.search', compact('employees'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Employee $employee)
    {
        //
    }

    public function edit(Employee $employee)
    {
        //
    }

    public function update(Request $request, Employee $employee)
    {
        //
    }

    public function destroy(Employee $employee)
    {
        //
    }

    public function priority($id)
    {
        $employee = EmployeeStatus::where('emp_id', $id)->first();

        if($employee){
            if($employee->isblacklist == True){
                $upd_emp = EmployeeStatus::where('emp_id', $employee->emp_id)
                            ->update([
                                'ispriority' => true,
                                'isblacklist' => false,
                            ]);
                
                if($upd_emp){
                    return back();
                }
            }
            
                $delete_emp = EmployeeStatus::where('emp_id', $id)->delete();

                if($delete_emp){
                    return back();
                }
          
        }else{
            $insert_priority_data = EmployeeStatus::create([
                'emp_id' => $id,
                'ispriority' => True
            ]);

            if($insert_priority_data){
                return back();
            }
        }   
    }

    public function blacklist($id)
    {
        $employee = EmployeeStatus::where('emp_id', $id)->first();

        if($employee){
            if($employee->ispriority == True){
                $upd_emp = EmployeeStatus::where('emp_id', $employee->emp_id)
                                ->update([
                                    'ispriority' => false,
                                    'isblacklist' => true,
                                ]);
                if($upd_emp){
                    return back();
                }
            }

            $delete_emp = EmployeeStatus::where('emp_id', $id)->delete();

                if($delete_emp){
                    return back();
                }
        }else{
            $insert_priority_data = EmployeeStatus::create([
                'emp_id' => $id,
                'isblacklist' => 1
            ]);

            if($insert_priority_data){
                return back();
            }
        }
    }
}
