<?php

namespace App\Http\Controllers;

use App\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    public function index()
    {
        $open_schedules = DB::table('schedules')->where('status', 0)->limit(2);

        $schedules = DB::select('select * from schedules
                                where status = 0
                                union all
                                select top 2 * from schedules
                                where status = 1
                                order by date desc');

        return view('schedule.index', compact('schedules'));

    }
    
    public function latest_sched()
    {
        // $sched = Schedule::where('date', '>', date('Y-m-d'))->first();
        $sched = Schedule::where('day', 'Saturday')->first();
        $saturday = date('Y-m-d', strtotime($sched->date));
        $anyDay = date('Y-m-d', strtotime('1 day'));
        
        if($saturday < date('Y-m-d')){
            DB::update('update schedules set status = 0 where status = ? and date <= ?', [1, $anyDay]);
        }
        
        $schedules = Schedule::where('status', 1)
                            ->limit(2)
                            ->get();
        
        return response()->json($schedules);
    }
}
