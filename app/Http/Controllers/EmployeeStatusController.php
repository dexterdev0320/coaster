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

        return view('emp_status.index', compact('statuses'));
    }

    public function priority(Request $request)
    {
        if(!empty($request->name)){
            $statuses = DB::table('employees_status')
                            ->join('employees', 'employees_status.emp_id', '=', 'employees.id')
                            ->select('employees.*', 'employees_status.ispriority')
                            ->where('employees.name', 'LIKE', '%'.$request->name.'%')
                            ->where('employees_status.ispriority', 1)
                            ->paginate(10);
            $pagination = $statuses->appends(array(
                'name' => $request->name
            ));
    
            
            if(count($statuses) > 0){
                return view('emp_status.index', compact('statuses'));
            }
        }
        $statuses = DB::table('employees_status')
                        ->join('employees', 'employees_status.emp_id', '=', 'employees.id')
                        ->select('employees.*', 'employees_status.ispriority')
                        ->where('employees_status.ispriority', 1)
                        ->paginate(10);

        return view('emp_status.index', compact('statuses'));
    }

    public function remove_priority($id)
    {
        $status = EmployeeStatus::where('emp_id', $id)->delete();

        if($status){
            return redirect('employees/priority');
        }
    }

    public function blacklist(Request $request)
    {
        if(!empty($request->name)){
            $statuses = DB::table('employees_status')
                            ->join('employees', 'employees_status.emp_id', '=', 'employees.id')
                            ->select('employees.*', 'employees_status.isblacklist')
                            ->where('employees.name', 'LIKE', '%'.$request->name.'%')
                            ->where('employees_status.isblacklist', 1)
                            ->paginate(10);
            $pagination = $statuses->appends(array(
                'name' => $request->name
            ));
            
            if(count($statuses) > 0){
                return view('emp_status.index', compact('statuses'));
            }
        }

        $statuses = DB::table('employees_status')
                        ->join('employees', 'employees_status.emp_id', '=', 'employees.id')
                        ->select('employees.*', 'employees_status.isblacklist')
                        ->where('employees_status.isblacklist', 1)
                        ->paginate(10);

        return view('emp_status.index', compact('statuses'));
    }

    public function remove_blacklist($id)
    {
        $status = EmployeeStatus::where('emp_id', $id)->delete();

        if($status){
            return redirect('employees/blacklist');
        }
    }
}
