<?php

namespace App\Http\Controllers;

use App\Coaster;
use Illuminate\Http\Request;

class CoasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('coaster.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Coaster  $coaster
     * @return \Illuminate\Http\Response
     */
    public function show(Coaster $coaster)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Coaster  $coaster
     * @return \Illuminate\Http\Response
     */
    public function edit(Coaster $coaster)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Coaster  $coaster
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coaster $coaster)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Coaster  $coaster
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coaster $coaster)
    {
        //
    }
}
