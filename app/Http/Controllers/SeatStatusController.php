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

    public function indiupdate(Request $request, $id){
        // dd($id);
        $seat = SeatStatus::where('id', $id)->update([
            'emp_id' => null,
            'code' => null,
            'dest_id' => null,
            'status' => 1
        ]);

        if($seat){
            return back();
        }
    }

    public function updateall(Request $request){
        // dd('yow');
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
        if(isset($status)){
            return back();
        }else{
            return back();
        }
    }

    public function update(Request $request, SeatStatus $seatStatus)
    {
        // dd($request->all());
        $seat = SeatStatus::where('id', $request->seat_id)
                        ->where('status', 1)
                        ->first();
        if($seat){
            $check_employee = SeatStatus::where('emp_id', $request->emp_id)->first();

            if($check_employee){
                return response()->json(['isvalid'=>false,'errors'=> 'Employee has already a seat']);
            }

            $upd_seat = SeatStatus::where('id', $request->seat_id)->update([
                        'emp_id' => $request->emp_id,
                        'code' => Str::random(5),
                        'dest_id' => $request->dest_id,
                        'status' => 0,
                    ]);
                
                if($upd_seat){
                    return response()->json($upd_seat);
                }
        }

        return response()->json(['error' => 'Seat is already booked']);

        // $seat = SeatStatus::where('id', $request->seat_id)->update([
        //     'emp_id' => $request->emp_id,
        //     'code' => Str::random(5),
        //     'dest_id' => $request->dest_id,
        //     'status' => 0,
        // ]);

        // if($seat){
        //     dd('hit');
        //     return new SeatStatus();
        // }
    }

    public function searchCode(Request $request){
        $seat = SeatStatus::where('code', 'LIKE', '%' . $request->seat_code . '%')->first();
        dd($seat);
    }

    public function destroy(SeatStatus $seatStatus)
    {
        //
    }
}
