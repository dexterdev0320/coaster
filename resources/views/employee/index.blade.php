@extends('layouts.app')

@section('content')
<employees-component></employees-component>
{{-- <div class="container">
    <div class="row">
        <div class="col-lg-12">
            @if (session('success') === false)
                <div class="alert alert-danger text-center">
                    {{ session('message') }}
                </div>
            @elseif(session('success') === true)
                <div class="alert alert-success text-center">
                    {{ session('message') }}
                </div>
            @endif
        </div>
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
                            <input type="text" name="name" 
                            class="form-control" 
                            placeholder="Employee's name" 
                            aria-label="Employee's name" 
                            aria-describedby="button-addon2"
                            value="{{ old('name') }}">
                            <div class="input-group-append">
                            <button class="btn btn-outline-secondary">Submit</button>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                Add Guest
                              </button>
                            </div>
                        </div>
                </form>
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Add Visitor</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('employee.addVisitor') }}" method="POST">
                                @csrf
                                <div>
                                    <label for="name">Guest's Name</label>
                                    <input type="text" name="name" 
                                    class="form-control @error('name') is-invalid @enderror " 
                                    placeholder="Name..." 
                                    aria-label="Guest's name" 
                                    aria-describedby="button-addon2"
                                    value="{{ old('name') }}" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mt-3">
                                    <label for="expiration date">Access Expiration Date</label>
                                    <input type="date" name="expiration_date" class="form-control @error('expiration_date') is-invalid @enderror" required>
                                    @error('expiration_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mt-3">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                      </div>
                    </div>
                  </div>
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
</div> --}}
@endsection
