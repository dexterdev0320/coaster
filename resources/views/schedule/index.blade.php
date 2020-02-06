@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card text-center">
			  <div class="card-header">
			    <h3>Schedule</h3>
			  </div>
			  <div class="card-body">
			    <div>
                    <table class="table table-striped table-hover">
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
                                        <td>{{ ($schedule->status == 1) ? 'Closed' : 'Open' }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
			  </div>
			   <div class="card-footer text-muted">
			    <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                      {{-- {{ $schedules->links() }} --}}
                    </ul>
                </nav>
			  </div>
			</div>
        </div>
    </div>
</div>
@endsection

