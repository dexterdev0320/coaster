@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 d-flex justify-content-between align-items-center">
            <div>
                <h2>Booking Record</h2>
            </div>
            <div>
                <button type="button" class="btn btn-danger mb-2" data-toggle="modal" data-target="#exampleModal">
                    Cancel Checked Seat/s
                </button>
            </div>
        </div>
    </div>
    <div class="row text-center">
        <div class="col-md-12">
            <form action="{{ route('seat.updateall') }}" method="POST">
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cancel Booking</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                        Are you sure you want to cancel the Reservation?
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-danger">Yes, please</button>
                        </div>
                    </div>
                    </div>
                </div>
            @csrf
                <div>
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th scope="col">NP</th>
                            <th scope="col">Seat No.</th>
                            <th scope="col">Employee ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Department</th>
                            <th scope="col">Destination</th>
                            <th scope="col">Seat Code</th>
                            <th scope="col">Status</th>
                            <th scope="col">Cancel</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($seats as $seat)
                                <tr>
                                    <td><input type="checkbox" name="{{ $seat->id }}" {{ ($seat->emp_id) ? '' : 'hidden' }}></td>
                                    <th scope="row">{{ $seat->id }}</th>
                                    <td>{{ ($seat->emp_id) ? $seat->employee->emp_id : '' }}</td>
                                    <td>{{ ($seat->emp_id) ? $seat->employee->name : '' }}</td>
                                    <td>{{ ($seat->emp_id) ? $seat->employee->department : '' }}</td>
                                    <td>{{ ($seat->dest_id) ? $seat->destination->place : '' }}</td>
                                    <td>{{ $seat->code }}</td>
                                    <td>{{ $seat->status }}</td>
                                    <td><a href="{{ route('seat.updateindi', $seat->id) }}" class="btn btn-danger btn-sm" {{ ($seat->emp_id) ? '' : 'hidden' }}>Cancel</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

