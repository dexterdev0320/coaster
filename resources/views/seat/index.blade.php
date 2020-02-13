@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card text-center">
			  <div class="card-header">
			    <h3>Saturday Bookings</h3>
			  </div>
			  <div class="card-body">
                <form action="{{ route('seat.update') }}" method="POST">
                    <button class="btn btn-danger mb-2" >Cancel All Checked</button>
                    @csrf
                        <div>
                            <table class="table table-striped table-hover">
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
                                            <td><a href="#" class="btn btn-danger" {{ ($seat->emp_id) ? '' : 'hidden' }}>Cancel</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </form>
			    </div>
			   
			</div>
        </div>
    </div>
</div>
@endsection

