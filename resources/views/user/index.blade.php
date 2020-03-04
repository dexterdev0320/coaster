@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
			
            <div><h1>Users</h1></div>
			@if (session('message'))
				<div class="alert alert-success text-center">
					{{ session('message') }}
				</div>
			@endif
			    <table class="table table-striped">
				  <thead>
				    <tr>
				      <th scope="col">Id</th>
				      <th scope="col">Name</th>
				      <th scope="col">Email</th>
					  <th scope="col">Created on</th>
					  <th scope="col">Action</th>
				    </tr>
				  </thead>
				  <tbody>
				  	@foreach($users as $index=>$user)
				  		<tr>
				  			<th scope="row">{{ $index+1 }}</th>
				  			<td>{{ $user->name }}</td>
				  			<td>{{ $user->email }}</td>
							<td>{{ $user->created_at }}</td>
							<td><a href="{{ route('user.delete', $user->id) }}" class="btn btn-danger btn-sm">Delete</a></td>  
				  		</tr>
				  	@endforeach
				  </tbody>
				</table>
        </div>
    </div>
</div>
@endsection

