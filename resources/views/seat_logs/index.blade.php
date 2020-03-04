@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-5">
            <h3>Booking History</h3>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    {{-- <th scope="col">Seq No.</th> --}}
                    <th scope="col">Employee ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Seat #</th>
                    <th scope="col">Destination</th>
                    <th scope="col">Date</th>
                    <th scope="col">Day</th>
                    <th scope="col">Status</th>
                    <th scope="col">Cancelled by</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($logs as $log)
                        <tr>
                            {{-- <th scope="row">{{ $feedback->id }}</th> --}}
                            <td>{{ $log->emp_id }}</td>
                            <td>{{ $log->name }}</td>
                            <td>{{ $log->seat_no }}</td>
                            <td>{{ $log->destination }}</td>
                            <td>{{ $log->date }}</td>
                            <td>{{ $log->day }}</td>
                            <td class="{{ ($log->status == 'Booked') ? 'text-success' : 'text-danger' }}" >{{ $log->status }}</td>
                            <td>{{ $log->cancelledby }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>	    
	<div class="row">
        <div class="col-md-12">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                  {{-- {{ $employees->links() }} --}}
                </ul>
            </nav>
        </div>
    </div>
</div>
@endsection

