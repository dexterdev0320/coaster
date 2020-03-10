<?php

namespace App\Http\Controllers;

use App\Destination;
use App\Employee;
use App\EmployeeStatus;
use App\SeatStatus;
use App\Http\Resources\SeatStatus as SeatResource;
use App\Schedule;
use App\SeatLogs;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SeatStatusController extends Controller
{
    public function booking()
    {
        return view('booking.index');
    }

    public function monday()
    {
        $seats = SeatStatus::with('employee')
                            ->with('destination')
                            ->where('day', 'Monday')
                            ->where('status', 0)
                            ->get();
        
        if($seats){
            return view('seat.index', compact('seats'));
        }
    }

    public function saturday()
    {
        $seats = SeatStatus::with('employee')
                            ->with('destination')
                            ->where('day', 'Saturday')
                            ->where('status', 0)
                            ->get();
        if($seats){
            return view('seat.index', compact('seats'));
        }
    }

    public function summary(){
        return view('seat.show');
    }

    public function cancel(Request $request, $id)
    {
        $seat = SeatStatus::where('id', $id)->first();

        if($seat){
            $employee = Employee::where('id', $seat->emp_id)->first();

            if($employee){
                $destination = Destination::where('id', $seat->dest_id)->first();

                if($destination){
                    $schedule = Schedule::where('day', $seat->day)
                                            ->where('status', 1)
                                            ->orderBy('date', 'ASC')
                                            ->first();
                    if($schedule){
                        $log = SeatLogs::create([
                            'emp_id' => $employee->emp_id,
                            'name' => $employee->name,
                            'seat_no' => $seat->seat_no,
                            'destination' => $destination->place,
                            'day' => $schedule->day,
                            'date' => $schedule->date,
                            'status' => 'Cancelled',
                            'cancelledby' => auth()->user()->name
                        ]);

                        if($log){
                            $status = SeatStatus::where('id', $id)
                                                ->update([
                                                    'emp_id' => null,
                                                    'code' => null,
                                                    'dest_id' => null,
                                                    'status' => 1
                                                ]);
                            if($status){
                                return back();
                            }
                        }
                    }
                }
            }
        }
    }

    public function cancel_all(Request $request){
        $seats = $request->all();
        
        foreach($seats as $index=>$seat){
            if($index != '_token'){
                $seat = SeatStatus::where('id', $index)->first();

                if($seat){
                    $employee = Employee::where('id', $seat->emp_id)->first();

                    if($employee){
                        $destination = Destination::where('id', $seat->dest_id)->first();

                        if($destination){
                            $schedule = Schedule::where('day', $seat->day)
                                                    ->where('status', 1)
                                                    ->orderBy('date', 'ASC')
                                                    ->first();
                            if($schedule){
                                $log = SeatLogs::create([
                                    'emp_id' => $employee->emp_id,
                                    'name' => $employee->name,
                                    'seat_no' => $seat->seat_no,
                                    'destination' => $destination->place,
                                    'day' => $schedule->day,
                                    'date' => $schedule->date,
                                    'status' => 'Canceled',
                                    'cancelledby' => auth()->user()->name
                                ]);

                                if($log){
                                    $status = SeatStatus::where('id', $index)
                                                        ->update([
                                                            'emp_id' => null,
                                                            'code' => null,
                                                            'dest_id' => null,
                                                            'status' => 1
                                                        ]);
                                }
                            }
                        }
                    }
                }
            }
        }

        return back();
    }

    public function print($day)
    {
        $seats = SeatStatus::where('day', 'LIKE', '%'.$day.'%')->get();
        $schedule = Schedule::where('day', 'LIKE', '%'.$day.'%')
                            ->where('status', 1)
                            ->first();

        return view('seat.print', compact('seats', 'schedule'));
    }


    // API STARTS HERE
    
    public function indexapi()
    {
        $seats = SeatStatus::all();

        return SeatResource::collection($seats);
    }

    // UPDATE THE SCHEDULE
    public function refresh_all(Request $request)
    {
        dd($request->all());
        $saturday = $request->saturday;
        
        $dateToday = date("Y-m-d");

        if($saturday['date'] >= $dateToday){
            return response()->json(['success' => false, 'message' => 'No schedule to be updated.']);
        }

        foreach($request->all() as $request){
            Schedule::where('id', $request['id'])
                    ->update([ 'status' => 0]);
        }
        return response()->json(['success' => true, 'message' => 'Schedule updated successfully']);
        
    }

    
    public function seats(Request $request)
    {
        $sched = Schedule::where('day', 'Monday')->where('status', 0)->orderBy('date', 'DESC')->first();
        
        SeatStatus::where('status', 0)
        ->where(DB::raw("CONVERT(date, updated_at, 110)"), '<', $sched->date)
        ->update([
            'emp_id' => null,
            'code' => null,
            'dest_id' => null,
            'status' => 1
        ]);

        $seats = SeatStatus::with('employee')->where('day', 'like', '%'.$request->day.'%')->get();
    
        if(count($seats) != 0){
            return SeatResource::collection($seats);
        }
        
        return SeatResource::collection($seats);
    }
    
    public function update(Request $request, SeatStatus $seatStatus)
    {
        // dd($request->all());
        $seat = SeatStatus::where('seat_no', $request->seat_no)
                        ->where('status', 1)
                        ->where('day', $request->day)
                        ->first();
        
        if($seat){

            $check_employee = SeatStatus::where('emp_id', $request->emp_id)
                                        ->where('day', $request->day)
                                        ->first();

            if($check_employee){
                return response()->json(['success'=>false, 'message'=> 'Employee already have a seat']);
            }
            // dd($request->code);
            $upd_seat = SeatStatus::where('seat_no', $request->seat_no)
                                    ->where('day', $request->day)
                                    ->update([
                                            'emp_id' => $request->emp_id,
                                            'code' => $request->code,
                                            'dest_id' => $request->dest_id,
                                            'status' => 0,
                                        ]);
                   
                if($upd_seat){
                    
                    $employee = Employee::where('id', $request->emp_id)->first();

                    if($employee){
                        $destination = Destination::where('id', $request->dest_id)->first();
                        
                        if($destination){
                            $log = SeatLogs::create([
                                'emp_id' => $employee->emp_id,
                                'name' => $employee->name,
                                'seat_no' => $request->seat_no,
                                'destination' => $destination->place,
                                'day' => $request->day,
                                'date' => Carbon::today(),
                                'status' => 'Booked',
                            ]);
                            if($log){
                                return response()->json(['success' => true, 'message' => "Success! Your booking was confirmed"]);
                            }
                        }
                    }

                    
                }
        }

        return response()->json(['success' => false, 'message' => 'Seat is already booked']);
    }

    public function cancelBooking(Request $request)
    {
        $updateSeat = SeatStatus::where('id', $request->seatID)->update([
            'emp_id' => null,
            'code' => null,
            'dest_id' => null,
            'status' => 1
        ]);

        if($updateSeat){
            return response()->json(['success' => true, 'message' => "Cancel Booking successfully!"]);
        }
    }
}
