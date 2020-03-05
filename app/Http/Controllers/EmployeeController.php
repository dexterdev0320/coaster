<?php

namespace App\Http\Controllers;

use App\Destination;
use App\Employee;
use App\EmployeeStatus;
use App\SeatStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        if(!empty($request->name)){
            $employees = DB::table('employees')
                        ->leftJoin('employees_status', 'employees.id', '=', 'employees_status.emp_id')
                        ->select(['employees.*', 'employees_status.ispriority', 'employees_status.isblacklist'])
                        ->where('name', 'LIKE', '%' . $request->name . '%')
                        ->where('isactive', 1)
                        ->paginate(13)
                        ->appends(['name' => $request->name]);
                        
            return view('employee.index', compact('employees'));
        }

        $employees = DB::table('employees')
                        ->leftJoin('employees_status', 'employees.id', '=', 'employees_status.emp_id')
                        ->select(['employees.*', 'employees_status.ispriority', 'employees_status.isblacklist'])
                        ->where('employees.isactive', 1)
                        ->paginate(13);

        return view('employee.index', compact('employees'));
    }

    public function priority(Request $request, $id)
    {
        $employee = EmployeeStatus::where('emp_id', $id)->first();

        if(!$employee){
            $insert_priority_data = EmployeeStatus::create([
                'emp_id' => $id,
                'ispriority' => True
            ]);
        }

        if(isset($insert_priority_data)){
            return back();
        }

        if($employee->isblacklist == True){
            $upd_emp = EmployeeStatus::where('emp_id', $employee->emp_id)
                        ->update([
                            'ispriority' => true,
                            'isblacklist' => false,
                        ]);
        }

        if(isset($upd_emp)){
            return back();
        }
        
        $delete_emp = EmployeeStatus::where('emp_id', $id)->delete();

        if($delete_emp){
            return back();
        }
        
    }

    public function blacklist($id)
    {
        $employee = EmployeeStatus::where('emp_id', $id)->first();

        if(!$employee){
            $insert_priority_data = EmployeeStatus::create([
                'emp_id' => $id,
                'isblacklist' => 1
            ]);
        }

        if(isset($insert_priority_data)){
            return back();
        }

        if($employee->ispriority == True){
            $upd_emp = EmployeeStatus::where('emp_id', $employee->emp_id)
                            ->update([
                                'ispriority' => false,
                                'isblacklist' => true,
                            ]);
        }

        if(isset($upd_emp)){
            return back();
        }

        $delete_emp = EmployeeStatus::where('emp_id', $id)->delete();

        if($delete_emp){
            return back();
        }
        
    }

    public function addvisitor(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'name' => 'required|min:3',
            'expiration_date' => 'required|date'
        ]);

        if($validation->fails()){
            return back()->withErrors($validation);
        }

        $visitorID = Employee::where('emp_id', 'NOT LIKE', '%PMC%')->orderBy('created_at', 'DESC')->first();

        if(!isset($visitorID)){
            $addVisitor = Employee::create([
                'emp_id' => 1,
                'name' => $request->name,
                'expiration_date' => $request->expiration_date,
                'isactive' => 1
            ]);
        }

        if(isset($addVisitor)){
            return redirect('employees')->with(['message' => 'Visitor added successfully']);
        }

        $addVisitor = Employee::create([
            'emp_id' => $visitorID->emp_id + 1,
            'name' => $request->name,
            'expiration_date' => $request->expiration_date,
            'isactive' => 1
        ]);
        
        return redirect('employees')->with(['message' => 'Visitor added successfully']);
    }

    // API STARTS HERE
    public function test()
    {
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
        dd($result);
        foreach($result as $check){
            dd($check);
        }

    }
    // SEARCH EMPLOYEE
    public function search_employee(Request $request)
    {
        $this->validate($request, [
            'seat_no' => 'required',
            'emp_id' => 'required',
            'dest_id' => 'required',
            'day' => 'required',
        ]);
        
        $seat = SeatStatus::where('seat_no', $request->seat_no)
                        ->where('day', $request->day)
                        ->first();

        if(!isset($seat)){
            return response()->json(['success' => false, 'message' => "We couldn't find the seat, please select another seat. Thanks"]);
        }

        $employees = Employee::where('emp_id', $request->emp_id)->where('isactive', 1);
        $count_employees = count($employees->get());

        if($count_employees > 1){
            return response()->json(['success' => false, 'message' => "The Employee's ID that you have been entered has too many result"]);
        }
        
        if($count_employees < 1){
            return response()->json(['success' => false, 'message' => "We couldn't find the Employee's ID that you have been entered"]);
        }

        if($count_employees == 1){
            $employee = $employees->first();
        }

        if($employee->expiration_date != null && $employee->expiration_date <= date('Y-m-d')){
            $employeeInActive = Employee::where('id', $employee->id)->update(['isactive' => 0]);
        }

        if(isset($employeeInActive)){
            return response()->json(['success' => false, 'message' => "The Employee is not Active"]);
        }

        $seat_check = SeatStatus::where('emp_id', $employee->id)
                                ->where('day', $request->day)
                                ->first();

        if(isset($seat_check)){
            return response()->json(['success' => false, 'message' => "Employee already have a seat"]);
        }

        $employee_status = EmployeeStatus::where('emp_id', $employee->id)->first();

        if(isset($employee_status)){
            $employee_blacklisted = $employee_status->isblacklist;
            $employee_priority = $employee_status->ispriority;
        }
        
        if(isset($employee_blacklisted) && $employee_blacklisted == 1){
            return response()->json(['success' => false, 'message' => 'The Employee is in the Blacklist']);
        }

        if(isset($employee_priority) && $employee_priority == 1){
            $employee_seat_status = SeatStatus::where('emp_id', $employee->id)
                                ->where('day', $request->day)
                                ->first();
        }
        
        if(isset($employee_seat_status)){
            return response()->json(['success' => false, 'message' => "Employee already have a seat"]);
        }
        
        if(!isset($employee_status) && date('l') != 'Friday'){
            return response()->json(['success' => false, 'message' => 'The Employee is not in the Priority list']);
        }

        $destination = Destination::where('id', $request->dest_id)->first();

        if(!isset($destination)){
            return response()->json(['success' => false, 'message' => "Please select Destination"]);
        }

        $code = strtoupper(Str::random(5));
        $employee = $employee->setAttribute('code', $code);
        return response()->json(['success' => true, 'message' => "Please check the details", 'data' => $employee]);
        
    }
}
