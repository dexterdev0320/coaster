<?php

namespace App\Http\Controllers;

use App\Employee;
use App\SeatStatus;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    public function index()
    {
        $seats = SeatStatus::all();
        $seats_available = SeatStatus::where('status', 1)->get();
        $seats_reserved = SeatStatus::where('status', 0)->get();
        return view('employees.index', compact('seats', 'seats_available', 'seats_reserved'));
    }

    public function testing()
    {
        $seats = SeatStatus::all();
        $seats_available = SeatStatus::where('status', 1)->get();
        $seats_reserved = SeatStatus::where('status', 0)->get();
        return view('employees.old_index', compact('seats', 'seats_available', 'seats_reserved'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Employee $employee)
    {
        //
    }

    public function edit(Employee $employee)
    {
        //
    }

    public function update(Request $request, Employee $employee)
    {
        //
    }

    public function destroy(Employee $employee)
    {
        //
    }
}
