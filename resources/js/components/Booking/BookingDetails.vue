<template>
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
</template>

<script>
export default {

}
</script>