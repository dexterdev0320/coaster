@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1>TRIP SCHEUDLE</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h3>Current Schedule of Service :
                Starts at # |
                Ends at #
            </h3>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-lg-12">
            <form action="{{ route('trip.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="day">Day</label>
                            <select name="day" class="form-control">
                                <option value="Monday">Monday</option>
                                <option value="Tuesday">Tuesday</option>
                                <option value="Wednesday">Wednesday</option>
                                <option value="Thursday">Thursday</option>
                                <option value="Friday">Friday</option>
                                <option value="Saturday">Saturday</option>
                                <option value="Sunday">Sunday</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="time">Time</label>
                            <input type="time" name="time" class="form-control @error('time') is-invalid @enderror">
                            @error('time')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" class="form-control">
                            <option value="Start">Start</option>
                            <option value="End">End</option>
                        </select>
                    </div>                     
                    </div>
                    <div class="col-lg-3">
                        <div class="row">
                            <div class="col-lg-12">
                            <label for="isactive">Active</label>
                            </div>
                            <div class="col-lg-12">
                            <input type="checkbox" name="isactive">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

