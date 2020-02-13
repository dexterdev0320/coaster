@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card text-center">
			  <div class="card-header">
			    <h3>Employees</h3>
			  </div>
			  <div class="card-body">
                <form action="{{ route('employee.search') }}" method="POST">
                    @csrf
                        <div class="input-group mb-4 mt-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Search</span>
                            </div>
                            <input type="text" name="name" class="form-control" placeholder="Employee's name" aria-label="Employee's name" aria-describedby="button-addon2">
                            <div class="input-group-append">
                            <button class="btn btn-outline-secondary">Button</button>
                            </div>
                        </div>
                    </form>
			    <div>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Employee ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Department</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            {{-- {{ dd($employees->links()) }} --}}
                            @foreach($employees as $employee)
                                <tr>
                                    <th scope="row">{{ $employee->emp_id }}</th>
                                    <td>{{ $employee->name }}</td>
                                    <td>{{ $employee->dept }}</td>
                                    <td>
                                        <a href="{{ route('employee.priority', $employee->id) }}" class="btn btn-success">{{ ($employee->ispriority) ? 'Remove Priority' : 'Priority' }}</a> 
                                        <a href="{{ route('employee.blacklist', $employee->id) }}" class="btn btn-danger">{{ ($employee->isblacklist) ? 'Remove Blacklist' : 'Blacklist' }}</a> 
                                        {{-- <a 
                                        href="{{ route('employee.blacklist', $employee->id) }}" 
                                        class="btn btn-danger">
                                        Blacklist
                                        </a> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
			  </div>
			   <div class="card-footer text-muted">
			    <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                      {{ $employees->links() }}
                    </ul>
                  </nav>
			  </div>
			</div>
        </div>
    </div>
</div>
@endsection

