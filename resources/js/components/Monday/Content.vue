<template>
    <div class="row justify-content-center mt-3">
        <div class="col-lg-3 d-flex align-items-center">
			<img src="image/ulo2.png" alt="">
		</div>

        <div class="col-lg-5" style="border: 1px solid gray">
			<div class="row mt-3">
                <h1>MONDAY SCHEDULE</h1>
			</div>
		</div>

        <div class="col-lg-4">
			<div class="row p-3">

				<div class="col-lg-12 alert alert-success">
					<h3>Available: 0 Seats</h3>
				</div>

				<div class="col-lg-12 alert alert-danger">
					<h3>Reserved: 0 Seats</h3>
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
</template>