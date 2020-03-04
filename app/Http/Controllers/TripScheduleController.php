<?php

namespace App\Http\Controllers;

use App\TripSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TripScheduleController extends Controller
{

    public function index()
    {
        $start = TripSchedule::where('status', 'Start')->where('isactive', 1)->first();
        $end = TripSchedule::where('status', 'End')->where('isactive', 1)->first();

        return view('schedule_trip.index', compact('start', 'end'));
    }

    public function trip_sched()
    {
        $trips = TripSchedule::where('isactive', 1)->get();

        return response()->json($trips);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'day' => 'required',
            'time' => 'required',
            'status' => 'required',
        ]);

        if($validate->fails()){
            return back()->withErrors($validate);
        }

        $schedule = TripSchedule::where('day', $request->day)
                            ->where('status', $request->status)
                            ->first();
        if(isset($schedule)){
            if(isset($request->isactive)){
                $active_schedule = TripSchedule::where('status', $request->status)
                                    ->where('isactive', 1)
                                    ->first();
                if(isset($active_schedule)){
                    $update_active_schedule = TripSchedule::where('id', $active_schedule->id)
                                                        ->update([
                                                            'isactive' => 0
                                                        ]);
                    if($update_active_schedule){
                        $update_new_active_schedule = TripSchedule::where('id', $schedule->id)
                                                                ->update([
                                                                    'time' => $request->time,
                                                                    'isactive' => 1
                                                                ]);
                        if($update_new_active_schedule){
                            return redirect('admin/trip-schedule');
                        }
                    }
                }
            }

            $update_schedule = TripSchedule::where('id', $schedule->id)
                                            ->update([
                                                'time' => $request->time,
                                            ]);
            if($update_schedule){
                return redirect('admin/trip-schedule');
            }
        }

        if(isset($request->isactive)){
            $active_schedule = TripSchedule::where('status', $request->status)
                                    ->where('isactive', 1)
                                    ->first();

            if(isset($active_schedule)){
                $update_active_schedule = TripSchedule::where('id', $active_schedule->id)
                                                    ->update([
                                                        'isactive' => 0
                                                    ]);
                if($update_active_schedule){
                    $create_schedule = TripSchedule::create([
                        'day' => $request->day,
                        'time' => $request->time,
                        'status' => $request->status,
                        'isactive' => 1
                    ]);
            
                    if($create_schedule){
                        return redirect('admin/trip-schedule');
                    }
                }
            }

            $create_schedule = TripSchedule::create([
                'day' => $request->day,
                'time' => $request->time,
                'status' => $request->status,
                'isactive' => 1
            ]);
    
            if($create_schedule){
                return redirect('admin/trip-schedule');
            }
        }
        
        $create_schedule = TripSchedule::create([
            'day' => $request->day,
            'time' => $request->time,
            'status' => $request->status,
            'isactive' => 0
        ]);

        if($create_schedule){
            return redirect('admin/trip-schedule');
        }
    }
}
