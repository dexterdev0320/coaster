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
        $todayPlusTwo = date('Y-m-d', strtotime('2 days'));
        $today = date('Y-m-d');
        $schedules = Schedule::where('status', 1)
                            ->limit(2)
                            ->get();

        $schedulesDecoded = json_decode($schedules);
        
        $scheduleSaturdayIndex = array_search('Saturday', array_column($schedulesDecoded, 'day'), True);

        $scheduleSaturday = $schedules[$scheduleSaturdayIndex];
        
        if($scheduleSaturday->date < $today){
            DB::update('update schedules set status = 0 where status = ? and date <= ?', [1, $todayPlusTwo]);
        }

        $schedules = Schedule::where('status', 1)
                            ->limit(2)
                            ->get();
        
        return response()->json($schedules);
    }
}
