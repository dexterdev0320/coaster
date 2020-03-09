<?php

namespace App\Http\Controllers;

use App\SeatLogs;
use Illuminate\Http\Request;

class SeatLogsController extends Controller
{

    public function index()
    {
        $logs = SeatLogs::orderBy('created_at', 'desc')->paginate(13);

        if($logs){
            return view('seat_logs.index', compact('logs'));
        }
    }
}
