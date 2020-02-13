<template>
<div>
    <div class="row justify-content-center mt-3">
        <div class="col-lg-3 d-flex align-items-center">
			<img src="image/ulo2.png" alt="">
		</div>

        <div class="col-lg-5" style="border: 1px solid gray">
			<div class="row mt-3">
				<div style="list-style-type: none; flex-wrap: wrap;" class="d-flex p-2 w-100">
				
					<div v-for="seat in seats" :key="seat.id">
						<li  class="m-2"  @click="seat_form.seat_id = seat.id"
						v-if="seat.id > 16 && seat.id < 24" 
						style="background-image: url('image/stall.png'); background-repeat: no-repeat; width: 40px;height: 40px;">
							{{ seat.id }}
						</li>
						<li v-else class="m-2"  @click="seat_form.seat_id = seat.id"
							style="background-repeat: no-repeat; width: 40px;height: 40px;"
							:style="'background-image: url('+imageSelected(seat.status)+')'">
							<a>
								{{ seat.id }}
							</a>
						</li>
					</div>
				
				</div>
				<!-- <div class="col-lg-1 mt-3 mb-3 ml-2 mr-2 d-flex" v-for="seat in seats" :key="seat.id">
                	<input type="radio" :name="'seat_'+seat.id" :value="seat.id" v-model="seatno" v-bind:disabled="seat.status === 'Occupied'">
					<img :src="imageSelected(seat.status)" alt="">
				</div> -->
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

	<div class="row mt-3">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header alert alert-info">
				  Booking Details
				</div>
				<div class="card-body">
					<form @submit.prevent="updateSeat(seat_form)">
						<div class="row">
							<div class="col-2 d-flex justify-content-center align-items-center"><h3>Seat no: {{ seat_form.seat_id }}</h3></div>
							<div class="col-5">
								<select class="custom-select" id="inputGroupSelect02" name="employee">
									<option selected disabled>Choose...</option>
									<option v-for="employee in employees" :key="employee.id" :value="employee.id" :selected="seat_form.emp_id = employee.id">{{employee.emp_id}}</option>
								</select>
							</div>
							<div class="col-3">
								<select class="custom-select" id="inputGroupSelect01" name="destination">
									<option v-for="dest in destinations" :key="dest.id" :value="dest.id" :selected="seat_form.dest_id = dest.id">{{dest.place}}</option>
								</select>
							</div>
							<div class="col-2"><button class="btn btn-primary">Submit</button></div>
						</div>
					</form>
					<hr>
					<div class="row">
						<div class="col-12">
							<h1>DETAIls</h1>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</template>

<script>
export default {
	props: ['seats', 'employees', 'destinations'],
	data() {
		return {
			seatno: '',
			seat_selected: false,
			src: '',
			seat_form: {
				seat_id: '',
				emp_id: '',
				dest_id: '',
			}
		}
	},
	methods: {
		imageSelected(status){
			if(status === 'Occupied'){
				return 'image/booked_seat_img.gif';
			}else{
				return 'image/available_seat_img.gif';
			}
		},
		changeImage() {
			
		},
		updateSeat(datas){
			this.$emit('updateSeat', datas);
		}

	}
}
</script>