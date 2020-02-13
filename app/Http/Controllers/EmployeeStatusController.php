<?php

namespace App\Http\Controllers;

use App\Employee;
use App\EmployeeStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeStatusController extends Controller
{
    public function index()
    {
        $statuses = EmployeeStatus::paginate(10);
        // dd($statuses);
        return view('emp_status.index', compact('statuses'));
    }

    // public function priority($id)
    // {
    //     $status = EmployeeStatus::where('emp_id',$id)->delete();
        
    //     if($status){
    //         return redirect('employee/status');
    //     }
    // }

    public function priority(Request $request)
    {
        if(!empty($request->name)){
            $statuses = DB::table('employee_statuses')
                            ->join('employees', 'employee_statuses.emp_id', '=', 'employees.id')
                            ->select('employees.*', 'employee_statuses.ispriority')
                            ->where('employees.name', 'LIKE', '%'.$request->name.'%')
                            ->where('employee_statuses.ispriority', 1)
                            ->paginate(10);
            $pagination = $statuses->appends(array(
                'name' => $request->name
            ));
            // dd($statuses);
            
            if(count($statuses) > 0){
                return view('emp_status.index', compact('statuses'));
            }
        }
        $statuses = DB::table('employee_statuses')
                        ->join('employees', 'employee_statuses.emp_id', '=', 'employees.id')
                        ->select('employees.*', 'employee_statuses.ispriority')
                        ->where('employee_statuses.ispriority', 1)
                        ->paginate(10);
        // dd($statuses);
        return view('emp_status.index', compact('statuses'));
    }

    public function remove_priority($id)
    {
        $status = EmployeeStatus::where('emp_id', $id)->delete();

        if($status){
            return redirect('admin/employee/status/priority');
        }
    }

    public function blacklist(Request $request)
    {
        if(!empty($request->name)){
            $statuses = DB::table('employee_statuses')
                            ->join('employees', 'employee_statuses.emp_id', '=', 'employees.id')
                            ->select('employees.*', 'employee_statuses.isblacklist')
                            ->where('employees.name', 'LIKE', '%'.$request->name.'%')
                            ->where('employee_statuses.isblacklist', 1)
                            ->paginate(10);
            $pagination = $statuses->appends(array(
                'name' => $request->name
            ));
            // dd($statuses);
            
            if(count($statuses) > 0){
                return view('emp_status.index', compact('statuses'));
            }
        }

        $statuses = DB::table('employee_statuses')
                        ->join('employees', 'employee_statuses.emp_id', '=', 'employees.id')
                        ->select('employees.*', 'employee_statuses.isblacklist')
                        ->where('employee_statuses.isblacklist', 1)
                        ->paginate(10);

        return view('emp_status.index', compact('statuses'));
    }

    public function remove_blacklist($id)
    {
        $status = EmployeeStatus::where('emp_id', $id)->delete();

        if($status){
            return redirect('admin/employee/status/blacklist');
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(EmployeeStatus $employeeStatus)
    {
        //
    }

    public function edit(EmployeeStatus $employeeStatus)
    {
        //
    }

    public function update(Request $request, EmployeeStatus $employeeStatus)
    {
        //
    }

    public function destroy(EmployeeStatus $employeeStatus)
    {
        //
    }
}
