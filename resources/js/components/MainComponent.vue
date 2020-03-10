<template>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 border-bottom border-primary">
                <ul class="nav justify-content-center">
                    <li class="nav-item">
                        <a 
                        class="nav-link"
                        v-bind:class="{'bg-primary':page === 'Saturday', 'text-white':page === 'Saturday'}"
                        v-on:click="page = 'Saturday'; component = 'Saturday';callSeatsAPI(component)"
                        style="cursor: pointer"
                        >Saturday ({{ moment(saturday.date, "YYYY-MM-DD").format("LL") }})</a>
                    </li>
                    <li class="nav-item">
                        <a 
                        class="nav-link" 
                        :class="{'bg-primary':page === 'Monday', 'text-white':page === 'Monday'}"
                        v-on:click="page = 'Monday'; component = 'Monday';callSeatsAPI(component)" 
                        style="cursor: pointer"
                        >Monday ({{ moment(monday.date, "YYYY-MM-DD").format("LL") }})</a>
                    </li>
                    <li class="nav-item">
                    <a 
                    :class="{'bg-primary':page === 'Feedback', 'text-white':page === 'Feedback'}"
                    class="nav-link" v-on:click="page = 'Feedback';callSeatsAPI(page)"
                    style="cursor: pointer"
                    >Feedback Form
                    </a>
                    </li>
                </ul>
            </div>
        </div>
        <div v-if="page === 'Feedback'" class="row mt-3">
            <div class="col-lg-12">
                <div><label for="comment">We would like to hear your feedback, inquiries and comments</label></div>
            <div>
                <textarea name="comment" class="form-control" :class="{'is-invalid': feedback_error.comment}" v-model="feedback.comment" placeholder="Comment here..." cols="30" rows="10"></textarea>
                <span v-if="feedback_error.comment" class="text-danger">{{feedback_error.comment[0]}}</span>
            </div>
            </div>
            <div class="col-lg-12 mt-3">
                <div><label for="id">Employee's ID</label></div>
                <div>
                    <input type="text" class="form-control" :class="{'is-invalid': feedback_error.emp_id}" v-model="feedback.empID" placeholder="Type your ID here">
                    <span v-if="feedback_error.emp_id" class="text-danger">{{feedback_error.emp_id[0]}}</span>
                </div>
            </div>
            <div class="col-lg-12 mt-3">
                <div><button class="btn btn-primary" @click="submitFeedback">Submit</button></div>
            </div>
        </div>
        <div v-else>
            <!-- RUN IF DAY TODAY IS WEDNESDAY WITH THE TIME OF 6:00 AM
                RUN ENDS IF DAY TODAY IS SATURDAY WITH THE TIME OF 6:00 PM -->
            <div v-if="moment().day(1).hours(0) <= moment() && moment().day(6).hours(18) >= moment()">
                <div class="row text-danger">
                    <div class="col-lg-12 d-flex align-items-center">
                        <div class="p-3">
                            <label for="name"><i class="fa fa-user"></i>Driver</label>
                        </div>
                        <div class="p-3">
                            <label v-if="page=='Saturday'" for="date"><i class="fas fa-calendar-alt"></i> Date {{ moment(saturday.date, "YYYY-MM-DD").format("LL") }} (Sat)</label>
                            <label v-else for="date"><i class="fas fa-calendar-alt"></i> Date {{ moment(monday.date, "YYYY-MM-DD").format("LL") }} (Mon)</label>	
                        </div>
                        <div class="p-3">
                            <label v-if="page=='Saturday'" for="time"><i class="fa fa-history"></i> 12:30 PM</label>
                            <label v-else><i class="fa fa-history"></i> 04:00 AM</label>
                        </div>  
                        <div class="p-3">
                            <label v-if="page=='Saturday'" for="dest"><i class="fa fa-tags"></i> Agusan to Davao</label>
                            <label v-else for="dest"><i class="fa fa-tags"></i> Davao to Agusan</label>
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
                    <div class="col-lg-5 d-flex" style="border: 1px solid gray">
                        <div class="row">
                            <div style="list-style-type: none; flex-wrap: wrap;" class="d-flex justify-content-center p-2 w-100">
                                <div v-for="(seat, index) in seats" :key="seat.id">
                                    <!-- seatno = seat.id -->
                                    <li :class="{highlight:seat.id == selected}" class="m-2 seat_hover"  @click="seatStatus(seat.id, seat.status, seat.seat_no)"
                                        style="background-repeat: no-repeat; width: 40px;height: 40px; cursor: pointer"
                                        :style="{'background-image': 'url('+imageSelected(seat.status, seat.id, index)+')'}"
                                        
                                        >
                                        <a>
                                            {{ seat.seat_no }}
                                        </a>
                                    </li>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="row p-3">
                            <div class="col-lg-12 alert alert-success">
                                <h3>Available: {{ seatsAvailable }} Seats</h3>
                            </div>
                            <div class="col-lg-12 alert alert-danger">
                                <h3>Reserved: {{ seatsOccupied }} Seats</h3>
                            </div>
                        </div>
                        <div class="row p-3">
                            <div class="col-lg-12 alert alert-info">
                                <h3>Inquire Booking:</h3>
                                    <div class="input-group mb-3">
                                        <input type="text" name="code" class="form-control" 
                                        placeholder="Enter Seat's code" aria-label="Recipient's username" 
                                        v-model="seat_code"
                                        @keypress.enter="searchCode(seat_code)">
                                        
                                        <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2" @click="searchCode(seat_code)">Search</button>
                                        </div>
                                    </div>
                                <transition name="fade">
                                    <div v-if="detail_visible === true">
                                    <hr>
                                    <!-- {{ search_code[0].seat_no }} ({{ search_code[0].employee.emp_id }}) -->
                                    <h5 style="color: blue;">Seat No: {{ search_code.seat_no }} ({{ search_code.emp_id }})</h5> 
                                    <button class="btn btn-danger btn-sm" @click="cancelBooking(search_code)">Cancel Booking</button>
                                    </div>
                                </transition>
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
                                    <div class="col-2 d-flex justify-content-center align-items-center">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <h3>Seat no: {{ seatno }}</h3>
                                            </div>
                                            <div class="col-lg-12">
                                                <span v-if="employee_error.seat_no" class="text-danger">Please select seats</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <input type="text" name="name" class="form-control" v-model="employee" placeholder="Type Employee's ID">
                                        <span v-if="employee_error.emp_id" class="text-danger">{{ employee_error.emp_id[0] }}</span>
                                    </div>
                                    <div class="col-3">
                                        <select class="custom-select" id="inputGroupSelect01" name="destination"  v-model="destid"> 
                                            <option disabled value="" selected>Choose Location</option>
                                            <option v-for="dest in destinations" :key="dest.id" :value="dest.id">{{dest.place}}</option>
                                        </select>
                                        <span v-if="employee_error.dest_id" class="text-danger">The destination field is required</span>
                                    </div>
                                    <div class="col-2">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary" @click="fetchEmployee(seatno, employee, destid, component)" data-toggle="modal" data-target="#staticBackdrop">
                                            Submit
                                        </button>
                                        <!-- Modal -->
                                        <div v-if="confirm_details">
                                            <transition name="modal">
                                                <div class="modal-mask">
                                                    <div class="modal-wrapper">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Booking Details</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true" @click="confirm_details = false">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row text-justify">
                                                                        <div class="col-lg-4 text-right">Employee's ID: </div>
                                                                        <div class="col-lg-8 text-left"><strong>{{ employees.emp_id }}</strong></div>
                                                                        <div class="col-lg-4 text-right">Name: </div>
                                                                        <div class="col-lg-8"><strong>{{ employees.name }}</strong></div>
                                                                        <div class="col-lg-4 text-right">Address: </div>
                                                                        <div class="col-lg-8"><strong>{{ employees.address }}</strong></div>
                                                                        <div class="col-lg-4 text-right">Department: </div>
                                                                        <div class="col-lg-8"><strong>{{ employees.dept }}</strong></div>
                                                                        <div class="col-lg-4 text-right">Location: </div>
                                                                        <div class="col-lg-8"><strong>{{ employees.location }}</strong></div>
                                                                        <div class="col-lg-4 text-right">Seat #: </div>
                                                                        <div class="col-lg-8"><strong>{{ seatno }}</strong></div>
                                                                        <div class="col-lg-4 text-right">Destination: </div>
                                                                        <div class="col-lg-8"><strong>{{ destination.place }}</strong></div>
                                                                        <div class="col-lg-4 text-right">Code: </div>
                                                                        <div class="col-lg-8"><strong class="text-danger">{{ employees.code }}</strong></div>
                                                                        <div class="col-lg-4 text-right"></div>
                                                                        <div class="col-lg-8"><strong class="text-info">Use this code to Inquire or Cancel your booking.</strong></div>
                                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" @click="confirm_details = false">Cancel</button>
                                                                    <button type="button" class="btn btn-primary" @click="updateSeat(destid, employees.id, destination.id, employees.code)">Continue</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </transition>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-else>
                <div class="row mt-5 d-flex justify-content-center text-center">
                    <div class="col-lg-12">
                        <h1 class="text-danger service">SERVICE UNAVAILABLE</h1>
                    </div>
                    <div class="col-lg-12">
                        <h4 v-if="moment().day(6) >= moment().day()">
                            <strong>Seat reservation wont start until {{ moment().day(3).hour(7).minute(0).second(0).format("dddd, MMMM Do YYYY, h:mm:ss A") }}</strong>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Axios from 'axios';
var moment = require('moment');
export default {
    data() {
        return {
            component: 'Saturday',
            page: 'Saturday',
            seats: [], 
            selected: undefined,
            seatno: '',
            seat_id: '',
            seats_available: 0,
            seats_reserved: 0,
            detail_visible: false,
            seat_code: '',
            seat_no: '',
            employee: '',
            employees: {},
            code: '',
            employee_error: [],
            confirm_details: false,
            empid: '',
            destinations: {
                id: '',
                place: '',
            },
            destination: {},
            destid: '',
            details: false,
            updateseat: {},
            schedules: [],
            feedback_error: [],
            feedback: { comment: '', empID: ''},
            moment: moment,
            saturday: [],
            monday: [],
            search_employee: {},
            search_code: {},
        }
    },
    mounted() {
        this.fetchSchedulesAPI();
        if(moment().day(1).hours(6) <= moment() && moment().day(6).hours(18) >= moment()){
            this.fetchSeatsAPI(this.component); 
            setInterval(() => this.fetchSeatsAPI(this.component), 3000)
            this.fetchDestinationAPI();
        }
        
    },
    methods: {
        fetchSeatsAPI(component){
            Axios.post('api/seats', {
                day: component,
                refresh: this.refresh
            })
                .then(res => this.seats = res.data.data)
                .catch(err => console.log(err));
        },
        fetchEmployee(seat_no, emp_id, dest_id, day){
            this.employees = {};
            Axios.post('api/employee', {
                seat_no: seat_no,
                emp_id: emp_id,
                dest_id: dest_id,
                day: day
            })
            .then(res => this.search_employee = res.data)
            .then(res => {
                if(this.search_employee.success == true){
                    this.confirm_details = res.success;
                    this.employees = res.data;
                    this.destination = this.destinations.find(e => e.id == this.destid);
                }else{
                    this.employee_error = [];
                    this.confirm_details = res.success;
                    toastr.error(this.search_employee.message);
                }
            })
            .catch(error => {
                if(error.response.status == 422){
                    this.employee_error = error.response.data.errors
                }
            })
        },
        fetchDestinationAPI(){
            Axios.get('api/destinations')
                .then(res => this.destinations = res.data.data)
                .catch(err => console.log(err))
        },
        fetchSchedulesAPI(){
            Axios.get('api/latest_sched')
                .then(res => this.schedules = res.data)
                .then(res => {
                    this.saturday = this.schedules.find(e => e.day === 'Saturday');
                    this.monday = this.schedules.find(e => e.day === 'Monday');
                })
                .catch(err => console.log(err))
        },
        imageSelected(status, id, index){
            index = index+1;
			if(status === 'Occupied'){
				return 'image/booked_seat_img.gif';
            }else{
                if(index > 16 && index < 24) {
                    
                    return 'image/stall.png';
                }else{
                    
                    return 'image/available_seat_img.gif';
                }
			}
        },
        seatStatus(id, status, seat_no){
            if(status === 'Occupied'){
                return toastr.error('Seat is already occupied. Please choose another seat');
            }else{
                this.seatno = seat_no;
                this.seat_id = id;
                this.selected = id;
            }
        },
        updateSeat(seatid, emp_id, dest_id, code){
            
                Axios.put('api/seat', {
                        seat_id: seatid,
                        emp_id: emp_id,
                        dest_id: dest_id,
                        day: this.component,
                        seat_no: this.seatno,
                        code: code,
                    })
                    .then(res => {
                        if(res.data.success === false){
                            toastr.error(res.data.message);
                        }else{
                            this.seats = this.seats.map(seat => seat.seat_no == this.seatno ? { ...seat, emp_id: this.employees.emp_id, dest_id, code, status: 'Occupied' } : seat );
                            this.seatno = '';
                            this.empid = '';
                            this.destid = '';
                            this.selected = undefined;
                            this.employee = '';
                            this.confirm_details = false;
                            this.employee_error = [];
                            toastr.success(res.data.message);
                        }
                    });
            
        },
        searchCode(code){
            const seats = this.seats;
            let success = false;
            if(this.seat_code === ''){
                toastr.warning('Please insert seat code');
            }else{
                this.search_code = seats.find(seat => seat.code == code);
                if(!this.search_code){
                    this.detail_visible = false;
                    return toastr.error('Seat code does not exist');
                }
                this.detail_visible = true;
            }
        },

        cancelBooking(details){
            let _this = this;
            swal({
                title: "Are you sure you want to cancel your booking?",
                text: "",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, cancel it!",
                cancelButtonText: "No",
                closeOnConfirm: false,
                closeOnCancel: false
                },
                function(isConfirm) {
                if (isConfirm) {
                    Axios.post('api/seat/cancel-booking', {
                        seatID: details.id
                    })
                    .then(res => {
                        if(res.success == false){
                            swal("Error!", res.message, "error");
                        }else{
                            _this.detail_visible = false;
                            _this.seat_code = ''; 
                            _this.seats = _this.seats.map(seat => (seat.id == details.id) ? { ...seat, emp_id: null, code: null, dest_id: null, status: 'Available' } : seat);
                            swal("Success!", res.message, "success"); 
                        }
                    })
                    .catch(err => console.log(err));
                } else {
                    swal("", "", "error");
                }
                });
        },

        callSeatsAPI(component){
            if(component != 'Feedback'){
                this.detail_visible = false;
                this.seat_no = '';
                this.seatno = '';
                this.selected = undefined;
                this.empid = '';
                this.destid = '';
                this.seat_code = '';
                this.employee = '';
                this.employee_error = [];
                this.feedback_error = [];  
            }
            this.fetchSeatsAPI(component);
        },
        submitFeedback(){
            Axios.post('api/feedback/store', {
                    comment: this.feedback.comment,
                    emp_id: this.feedback.empID
                })
                    .then(res => {
                        if(res.data.success){
                            this.feedback_error = [];
                            this.feedback.comment = '';
                            this.feedback.empID = '';
                            toastr.success(res.data.message);
                        }else{
                            this.feedback_error = [];
                            toastr.error(res.data.message);
                        }
                    })
                    .catch(error => {
                        if(error.response.status == 422){
                            this.feedback_error = error.response.data.errors;
                        }
                    });
        }
    },
    computed: {
        seatsAvailable() {
            return this.seats.filter(seat => seat.status == 'Available').length;
        },
        seatsOccupied() {
            return this.seats.filter(seat => seat.status == 'Occupied').length;
        }
    }
    
}
</script>

<style scoped>
    li.highlight{
        background-image: url('../assets/selected_seat_img.gif') !important;
    }
    .seat_hover:hover{
        background-color: yellow;
    }
    .service{
        font-size: 7em;
    }
    .modal-mask {
    position: fixed;
    z-index: 9998;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, .5);
    display: table;
    transition: opacity .3s ease;
    animation: fadein 0.3s;
    }

    .modal-wrapper {
    display: table-cell;
    vertical-align: middle;
    }
    @keyframes fadein {
    from { opacity: 0; }
    to   { opacity: 1; }
}
.fade-enter-active, .fade-leave-active {
  transition: opacity .5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
</style>