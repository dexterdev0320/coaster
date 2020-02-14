@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 d-flex justify-content-between align-items-center">
            <div>
                <h2>Booking Schedule</h2>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div>
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th scope="col">Seq No.</th>
                        <th scope="col">Date</th>
                        <th scope="col">Day</th>
                        <th scope="col">Status</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($schedules as $index=>$schedule)
                            @if ($index < 15)
                                <tr>
                                    <th scope="row">{{ $index+1 }}</th>
                                    <td>{{ $schedule->date }}</td>
                                    <td>{{ $schedule->day }}</td>
                                    <td>{{ ($schedule->status == 1) ? 'Open' : 'Closed' }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

