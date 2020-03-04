<?php

namespace App\Http\Controllers;

use App\Destination;
use App\Http\Resources\Destination as DestinationResource;
use App\SeatStatus;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function index()
    {
        return view('destination.index');
    }
    
    // API STARTS HERE

    // GET ALL THE DESTINATION
    public function fetch_all_destination()
    {
        $destinations = Destination::all();

        return DestinationResource::collection($destinations);
    }

    // INSERT NEW DESTINATION
    public function new_destination(Request $request)
    {
        $this->validate($request, [
            'destination' => 'required|min:3'
        ]);
        
        $dest = Destination::where('place', 'LIKE', '%' . $request->destination . '%')->get();

        if(count($dest) > 0){
            return response()->json(['success' => false, 'message' => 'Destination is already created']);
        }

        $store = Destination::create([
            'place' => $request->destination,    
        ]);

        if($store){
            return response()->json(['success' => true, 'message' => 'Destination created successfully']);
        }
    }

    // UPDATE DESTINATION
    public function update_destination(Request $request, $id)
    {
        $this->validate($request,[
            'id' => 'required',
            'destination' => 'required|min:3'
        ]);

        $dest = Destination::where('place', $request->destination)->get();

        if(count($dest) > 0){
            return response()->json(['success' => false, 'message' => 'Destination is already exist']);
        }

        $store = Destination::where('id', $request->id)
                            ->update([
                                'place' => $request->destination
                            ]);
        if($store){
            return response()->json(['success' => true, 'message' => 'Destination edited successfully']);
        }
    }

    // DELETE DESTINATION
    public function delete_destination($id)
    {
        $seats = SeatStatus::where('dest_id', $id)
                            ->get();
        if(count($seats) > 0){
            return response()->json(['success' => false, 'message' => 'Destination cannot be deleted, please ask the adminstrator']);
        }
        Destination::where('id', $id)->delete();
        return response()->json(['success' => true, 'message' => 'Destination removed successfully']);
    }
}
