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
			    <div>
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th scope="col">NP</th>
                            <th scope="col">Seat No.</th>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Seat Code</th>
                            <th scope="col">Destination</th>
                            <th scope="col">Department</th>
                            <th scope="col">Cancel</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $total_seat = 41;
                                $count_employees = count($bookings);
                                $exist = false;
                                
                                for ($i=0; $i < $total_seat; $i++) { 
                                    ?>
                                        <tr>
                                            <td><input type="checkbox"></td>
                                            <th scope="row">{{ $i+1 }}</th>
                                            @if (count($bookings) > 0)
                                                @foreach ($bookings as $key => $booking)
                                                    {{ ($exist = false) }}
                                                    @if ($booking->seat_no == $i+1)
                                                        <td>{{ $booking->employee->emp_id }}</td>
                                                        <td>{{ $booking->employee->name }}</td>
                                                        <td>{{ $booking->seat_no }}</td>
                                                        <td>{{ $booking->destination }}</td>
                                                        <td>{{ $booking->employee->dept }}</td>
                                                        <td><a href="#" class="btn btn-danger">Cancel</a></td>
                                                        
                                                        <?php $exist = true; unset($bookings[$i]); break; ?>
                                                    @endif
                                                @endforeach
                                                @if (!$exist)
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                @endif
                                            @endif
                                        </tr>
                                    <?php
                                }
                            ?>
                           {{--  @for ($i = 0; $i <= $total_seat; $i++)
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <th scope="row">{{ $i+1 }}</th>
                                    @if (count($bookings) > $i && $bookings[$i]->seat_no == $i+1)
                                        <th scope="row">{{ $bookings[$i]->employee->emp_id }}</th>
                                        <td>{{ $bookings[$i]->employee->name }}</td>
                                        <td>{{ $bookings[$i]->seat_code }}</td>
                                        <td>{{ $bookings[$i]->destination }}</td> 
                                        <td>{{ $bookings[$i]->employee->dept }}</td>
                                        <td><a href="#" class="btn btn-danger">Cancel</a></td>
                                    @else
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    @endif
                                </tr>
                            @endfor --}}
                            {{-- @foreach($employees as $employee)
                                <tr>
                                    <th scope="row">{{ $employee->emp_id }}</th>
                                    <td>{{ $employee->name }}</td>
                                    <td>{{ $employee->dept }}</td>
                                    <td>
                                        <a href="{{ route('employee.priority', $employee->id) }}" class="btn btn-success">{{ ($employee->ispriority) ? 'Remove Priority' : 'Priority' }}</a> 
                                        <a href="{{ route('employee.blacklist', $employee->id) }}" class="btn btn-danger">{{ ($employee->isblacklist) ? 'Remove Blacklist' : 'Blacklist' }}</a> 
                                    </td>
                                </tr>
                            @endforeach --}}

                            {{--
                                @foreach ($bookings as $booking)                                        
                                        @if ($booking->seat_no == $i)
                                            <th scope="row">{{ $booking->employee->emp_id }}</th>
                                            <td>{{ $booking->employee->name }}</td>
                                            <td>{{ $booking->seat_code }}</td>
                                            <td>{{ $booking->destination }}</td> 
                                            <td>{{ $booking->employee->dept }}</td>
                                            <td><a href="#" class="btn btn-danger">Cancel</a></td> 
                                        @endif
                                    @endforeach
                                --}}
                        </tbody>
                    </table>
                </div>
			  </div>
			   <div class="card-footer text-muted">
			    <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                      {{-- {{ $employees->links() }} --}}
                    </ul>
                  </nav>
			  </div>
			</div>
        </div>
    </div>
</div>
@endsection

