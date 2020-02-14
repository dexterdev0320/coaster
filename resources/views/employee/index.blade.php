@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 d-flex justify-content-between align-items-center">
            <div>
                <h2>Employees</h2>
            </div>
            <div>
                <form action="{{ route('employee.index') }}" method="POST">
                    @csrf
                        <div class="input-group mb-4 mt-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Search</span>
                            </div>
                            <input type="text" name="name" class="form-control" placeholder="Employee's name" aria-label="Employee's name" aria-describedby="button-addon2">
                            <div class="input-group-append">
                            <button class="btn btn-outline-secondary">Submit</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div>
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th scope="col">Employee ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Department</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($employees as $employee)
                            <tr>
                                <th scope="row">{{ $employee->emp_id }}</th>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->dept }}</td>
                                <td>
                                    <a href="{{ route('employee.priority', $employee->id) }}" class="btn btn-success btn-sm">{{ ($employee->ispriority) ? 'Remove Priority' : 'Priority' }}</a> 
                                    <a href="{{ route('employee.blacklist', $employee->id) }}" class="btn btn-danger btn-sm">{{ ($employee->isblacklist) ? 'Remove Blacklist' : 'Blacklist' }}</a> 
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 justify-content-center">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                  {{ $employees->links() }}
                </ul>
            </nav>
        </div>
    </div>
</div>
@endsection

