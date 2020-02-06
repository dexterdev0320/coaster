@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card text-center">
			  <div class="card-header">
			    <h3>Employee {{ (strpos($_SERVER['REQUEST_URI'], 'priority') ? 'Priorities' : 'Blacklist') }}</h3>
			  </div>
			  <div class="card-body">
                <form action="#" method="GET">
                        <div class="input-group mb-4 mt-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Search</span>
                            </div>
                            <input type="text" name="employee" class="form-control" placeholder="Employee's name" aria-label="Employee's name" aria-describedby="button-addon2">
                            <div class="input-group-append">
                            <button class="btn btn-outline-secondary">Button</button>
                            </div>
                        </div>
                    </form>
			    <div>
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Employee ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Department</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($statuses as $status)
                                <tr>
                                    <th scope="row">{{ $status->employee->emp_id }}</th>
                                    <td>{{ $status->employee->name }}</td>
                                    <td>{{ $status->employee->dept }}</td>
                                    <td>
                                        <a 
                                        href="{{ (strpos($_SERVER['REQUEST_URI'], 'priority')) ? 
                                        route('status.rmpriority', $status->emp_id) : 
                                        route('status.rmblacklist', $status->emp_id) }}" 
                                        class="btn btn-danger">
                                        {{ (strpos($_SERVER['REQUEST_URI'], 'priority')) ? 
                                        'Remove Priority' : 
                                        'Remove Blacklist' }}
                                        </a>
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
                      {{ $statuses->links() }}
                    </ul>
                  </nav>
			  </div>
			</div>
        </div>
    </div>
</div>
@endsection

