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
                  
                <form action="{{ (strpos($_SERVER['REQUEST_URI'], 'priority')) ? route('status.priority') : route('status.blacklist') }}" method="POST">
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
                                    <th scope="row">{{ $status->emp_id }}</th>
                                    <td>{{ $status->name }}</td>
                                    <td>{{ $status->dept }}</td>
                                    <td>
                                        <a 
                                        href="{{ (strpos($_SERVER['REQUEST_URI'], 'priority')) ? 
                                        route('status.rmpriority', $status->id) : 
                                        route('status.rmblacklist', $status->id) }}" 
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

