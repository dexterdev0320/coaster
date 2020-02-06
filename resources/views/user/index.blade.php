@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card text-center">
			  <div class="card-header">
			    Employees
			  </div>
			  <div class="card-body">
			    <table class="table table-striped">
				  <thead>
				    <tr>
				      <th scope="col">Employee ID</th>
				      <th scope="col">Name</th>
				      <th scope="col">Address</th>
				      <th scope="col">Department</th>
				      <th scope="col">Location</th>
				      <th scope="col">Expiration Date</th>
				      <th scope="col">Status</th>
				    </tr>
				  </thead>
				  <tbody>
				  	@foreach($employees as $employee)
				  		<tr>
				  			<th scope="row">{{ $employee->emp_id }}</th>
				  			<td>{{ $employee->name }}</td>
				  			<td>{{ $employee->address }}</td>
				  			<td>{{ $employee->dept }}</td>
				  			<td>{{ $employee->location }}</td>
				  			<td>{{ $employee->expiration_date }}</td>
				  			<td>{{ $employee->status }}</td>
				  		</tr>
				  	@endforeach
				  </tbody>
				</table>
			  </div>
			  <!-- <div class="card-footer text-muted">
			    2 days ago
			  </div> -->
			</div>
        </div>
    </div>
</div>
@endsection

