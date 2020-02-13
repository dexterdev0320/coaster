<template>
    <!-- STARTS HERE -->
    <div>

        <div class="row">
            <div class="col-lg-12 d-flex align-items-center">
                <div class="p-3">
                    <label for="name"><i class="fa fa-user"></i> Dexter</label>
                </div>
                <div class="p-3">
                    <label for="date"><i class="fa fa-calendar"></i> Date Today</label>	
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
                    <div style="list-style-type: none; flex-wrap: wrap;" class="d-flex p-2 w-100">
                    
                        <div v-for="seat in seats" :key="seat.id">
                            <!-- seatno = seat.id -->
                            <li :class="'seat_'+seat.id" class="m-2"  @click="seatStatus(seat.id, seat.status)"
                                style="background-repeat: no-repeat; width: 40px;height: 40px;"
                                :style="{'background-image': 'url('+imageSelected(seat.status, seat.id)+')'}"
                                >
                                <a>
                                    {{ seat.id }}
                                </a>
                            </li>
                        </div>
                    
                    </div>
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
                        <form @submit.prevent="updateSeat">
                            <div class="row">
                                <div class="col-2 d-flex justify-content-center align-items-center"><h3>Seat no: {{ seatno }}</h3></div>
                                <div class="col-5">
                                    <select class="custom-select" id="inputGroupSelect02" name="employee" v-model="empid">
                                        <option selected disabled>Choose Employee ID</option>
                                        <option v-for="employee in employees" :key="employee.id" :value="employee.id">{{employee.emp_id}}</option>
                                    </select>
                                </div>
                                <div class="col-3">
                                    <select class="custom-select" id="inputGroupSelect01" name="destination"  v-model="destid"> 
                                        <option selected disabled>Choose Destination</option>
                                        <option v-for="dest in destinations" :key="dest.id" :value="dest.id">{{dest.place}}</option>
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
    <!-- ENDS HERE -->
    </div>
</template>

<script>
import Axios from 'axios'

export default {
    data() {
        return {
            seats: {
                id: '',
                emp_id: '',
                code: '',
                dest_id: '',
                status: '',
            },
            seatno: '',
            employees: {
                id: '',
                emp_id: '',
            },
            empid: '',
            destinations: {
                id: '',
                place: '',
            },
            destid: '',
            updateseat: {},
            
        }
    },
    mounted() {
        console.log('SaturdayBooking');
        // this.fetchSeatsAPI();
    },
    created() {
        // THIS WILL REFRESH THE API EVERY 5 SECONDS
        setInterval(() => this.fetchSeatsAPI(), 5000);

        this.fetchSeatsAPI();
        this.fetchEmployeesAPI();
        this.fetchDestinationAPI();
    },
    methods: {
        fetchSeatsAPI(){
            Axios.get('api/seats')
                .then(res => this.seats = res.data.data)
                .catch(err => console.log(err))
        },
        fetchEmployeesAPI(){
            Axios.get('api/employees')
                .then(res => this.employees = res.data.data)
                .catch(err => console.log(err))
        },
        fetchDestinationAPI(){
            Axios.get('api/destinations')
                .then(res => this.destinations = res.data.data)
                .catch(err => console.log(err))
        },
        imageSelected(status, id){
			if(status === 'Occupied'){
				return 'image/booked_seat_img.gif';
            }else{
                if(id > 16 && id < 24) {
                    return 'image/stall.png';
                }else{
                    return 'image/available_seat_img.gif';
                }
			}
        },
        seatStatus(id, status){
            if(status === 'Occupied'){
                return alert('Seat is already occupied. Please choose another seat');
            }else{
                this.seatno = id;
            }
        },
        updateSeat(){
            if(this.seatno === '' || this.empid === '' || this.destid === ''){
                alert('Please fill out the form Details. Thanks')
            }else{
                Axios.put('api/seat', {
                        seat_id: this.seatno,
                        emp_id: this.empid,
                        dest_id: this.destid
                    })
                    .then(res => {
                        this.fetchSeatsAPI();
                        alert('Seat No.' + this.seatno + ' booked successfully');
                        this.seatno = '';
                        this.empid = '';
                        this.destid = '';
                    });
            }
        }
    }
    
}
</script>

