@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-5">
            <h3>Employee's Feedback</h3>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <table class="table table-bordered table-hover">
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
	<div class="row">
        <div class="col-md-12">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                  {{-- {{ $employees->links() }} --}}
                </ul>
            </nav>
        </div>
    </div>
</div>
@endsection

