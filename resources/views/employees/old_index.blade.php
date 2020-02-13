@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-lg-12 border-bottom border-primary">
			<ul class="nav justify-content-center">
				<li class="nav-item">
				  <a class="nav-link active" href="#">Saturday</a>
				</li>
				<li class="nav-item">
				  <a class="nav-link" href="#">Monday</a>
				</li>
				<li class="nav-item">
				  <a class="nav-link" href="#">Feedback Form</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 d-flex align-items-center">
			<div class="p-3">
				<label for="name"><i class="fa fa-user"></i> Dexter</label>
			</div>
			<div class="p-3">
				<label for="date"><i class="fa fa-calendar"></i> {{ \Carbon\Carbon::today() }}</label>	
			</div>
			<div class="p-3">
				<label for="time"><i class="fa fa-history"></i> 12:30 PM</label>
			</div>
			<div class="p-3">
				<label for="dest"><i class="fa fa-tags"></i> Agusan to Davao</label>
			</div>
			<div class="p-3 ml-5">
				<label for="legend">LEGEND: </label>
				<img src="image/available_seat_img.gif" alt="">
				<label>Available</label>
				<img src="image/booked_seat_img.gif" alt="">
				<label>Booked</label>
				<img src="image/stall.png" alt="">
				<label>Stool</label>
			</div>	
		</div>
	</div>
    <div class="row justify-content-center mt-3">
		
		<div class="col-lg-3 d-flex align-items-center">
			<img src="image/ulo2.png" alt="">
		</div>

		<div class="col-lg-5" style="border: 1px solid gray">
			<div class="row mt-3">
				@foreach ($seats as $index => $seat)
					@if ($index > 15 && $index < 23)

					<div class="col-lg-1 mt-3 mb-3 ml-2 mr-2 d-flex">
						<input type="radio" name="seat" value="{{ $seat->id }}" {{ ($seat->status == 'Available') ? '' : 'disabled'}}>
                		<img src="{{ ($seat->status == 'Available') ? 'image/stall.png' : 'image/booked_seat_img.gif' }}">
					</div>

					@else

					<div class="col-lg-1 mt-3 mb-3 ml-2 mr-2 d-flex">
						<input type="radio" name="seat" value="{{ $seat->id }}" {{ ($seat->status == 'Available') ? '' : 'disabled'}}>
                		<img src="{{ ($seat->status == 'Available') ? 'image/available_seat_img.gif' : 'image/booked_seat_img.gif' }}">
					</div>

					@endif
					
				@endforeach
			</div>
		</div>
		<div class="col-lg-4">
			<div class="row p-3">

				<div class="col-lg-12 alert alert-success">
					<h3>Available: {{ count($seats_available) }} Seats</h3>
				</div>

				<div class="col-lg-12 alert alert-danger">
					<h3>Reserved: {{ count($seats_reserved) }} Seats</h3>
				</div>

			</div>

			<div class="row p-3">
				<div class="col-lg-12 alert alert-info">
					<h3>Inquire Booking:</h3>

					<div class="input-group mb-3">
						<input type="text" name="code" class="form-control" placeholder="Enter Seat's code" aria-label="Recipient's username">
						
						<div class="input-group-append">
						  <button class="btn btn-outline-secondary" type="button" id="button-addon2">Button</button>
						</div>

					</div>
					
				</div>

			</div>
			
		</div>
	</div>
	<div class="row mt-3">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header alert alert-info">
				  Booking Details
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-2 d-flex justify-content-center align-items-center"><h3>Seat no: 7</h3></div>
						<div class="col-5"><input type="text" class="form-control" placeholder="Employee's ID"></div>
						<div class="col-3">
							<select class="custom-select" id="inputGroupSelect01">
								<option value="1">Davao</option>
								<option value="2">Bunawan</option>
								<option value="3">Tagum</option>
							  </select>
						</div>
						<div class="col-2"><button class="btn btn-primary">Submit</button></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</div>
@endsection

