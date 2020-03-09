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
        $dateToday = date('Y-m-d');

        $sched = Schedule::where(DB::raw("CONVERT(date, date, 110)"), '<', $dateToday)->where('day', 'Saturday')->orderBy('date', 'DESC')->first();
        
        $saturday = date('Y-m-d', strtotime($sched->date));
        
        if($saturday < $dateToday){
            $updateSchedule = DB::update('update schedules set status = 0 where status = ? and date < ?', [1, $dateToday]);
        }

        if(isset($updateSchedule)){
            $latestSaturday = Schedule::where('day', 'Saturday')->where('status', 0)->orderBy('date', 'DESC')->first();
            $latestSaturday = date('Y-m-d', strtotime($latestSaturday->date));
        }

        if($latestSaturday < $dateToday){
            $futureSaturday = Schedule::where('day', 'Saturday')->where(DB::raw("CONVERT(date, date, 110)"), '>', $dateToday)->first();
        }

        if(isset($futureSaturday)){
            DB::update('update schedules set status = 0 where status = ? and date < ?', [1, $futureSaturday->date]);
        }

        $schedules = Schedule::where('status', 1)
                            ->limit(2)
                            ->get();
        
        return response()->json($schedules);
    }
}
