<?php

namespace App\Http\Controllers;

use App\EmployeePriority;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeePriorityController extends Controller
{

    public function index()
    {
        $employees = DB::table('employees')
                        ->leftJoin('employee_priorities', 'employees.id', '=', 'employee_priorities.emp_id')
                        ->select(['employees.*', 'employee_priorities.emp_id as ep_emp_id'])
                        ->where('employee_priorities.emp_id', '!=', NULL)
                        ->paginate(10);
        // dd($employees);

        if($employees){
            return view('priority.index', compact('employees'));
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

    public function show(EmployeePriority $employeePriority)
    {
        //
    }

    public function edit(EmployeePriority $employeePriority)
    {
        //
    }

    public function update(Request $request, EmployeePriority $employeePriority)
    {
        //
    }

    public function destroy(EmployeePriority $employeePriority)
    {
        //
    }
}
