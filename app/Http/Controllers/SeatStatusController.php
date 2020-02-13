<?php

namespace App\Http\Controllers;

use App\SeatStatus;
use App\Http\Resources\SeatStatus as SeatResource;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SeatStatusController extends Controller
{
    public function index()
    {
        $seats = SeatStatus::all();
        // dd($seats);
        return view('seat.index', compact('seats'));
    }

    public function indexapi()
    {
        $seats = SeatStatus::all();
        // dd($seats);
        return SeatResource::collection($seats);
    }

    public function availableseats()
    {
        $seats = SeatStatus::where('status', '1')->get();

        return json_encode($seats);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(SeatStatus $seatStatus, Request $request)
    {
        //
    }

    public function edit(SeatStatus $seatStatus)
    {
        //
    }

    public function acupdate(Request $request){
        dd('yow');
        $seats = $request->all();
        foreach($seats as $k=>$v){
            if($k != '_token'){
                $status = SeatStatus::where('id', $k)
                            ->update([
                                'emp_id' => null,
                                'code' => null,
                                'dest_id' => null,
                                'status' => 1
                            ]);
            }
        }
        if($status){
            return back();
        }
    }

    public function update(Request $request, SeatStatus $seatStatus)
    {
        // dd($request->all());
        $seat = SeatStatus::where('id', $request->seat_id)->update([
            'emp_id' => $request->emp_id,
            'code' => Str::random(5),
            'dest_id' => $request->dest_id,
            'status' => 0,
        ]);

        if($seat){
            dd('hit');
            return new SeatStatus();
        }
    }

    public function destroy(SeatStatus $seatStatus)
    {
        //
    }
}
