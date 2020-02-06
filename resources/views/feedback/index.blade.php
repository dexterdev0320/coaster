@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card text-center">
			  <div class="card-header">
			    <h3>Employees Feedback</h3>
			  </div>
			  <div class="card-body">
			    <div>
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Seq No.</th>
                            <th scope="col">Employee's Name</th>
                            <th scope="col">Feedback</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($feedbacks as $feedback)
                                <tr>
                                    <th scope="row">{{ $feedback->id }}</th>
                                    <td>{{ $feedback->employee->name }}</td>
                                    <td>{{ $feedback->feedback }}</td>
                                </tr>
                            @endforeach
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

