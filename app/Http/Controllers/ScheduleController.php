<?php

namespace App\Http\Controllers;

use App\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    public function index()
    {
        // $schedules = Schedule::orderBy('date', 'desc')->paginate(10);
        $open_schedules = DB::table('schedules')->where('status', 0)->limit(2);
        // $schedules = DB::table('schedules')->where('status', 1)->orderBy('date', 'DESC')->LIMIT(18)->union($open_schedules)->get();
        $schedules = DB::select('select * from schedules
                                where status = 0
                                union all
                                select top 2 * from schedules
                                where status = 1
                                order by date desc');
        // dd($test);
        return view('schedule.index', compact('schedules'));

    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Schedule $schedule)
    {
        //
    }

    public function edit(Schedule $schedule)
    {
        //
    }

    public function update(Request $request, Schedule $schedule)
    {
        //
    }

    public function destroy(Schedule $schedule)
    {
        //
    }
}
