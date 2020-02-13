<template>
    <div>
        <Details/>
        <Content v-bind:seats="seats" v-bind:employees="employees" v-bind:destinations="destinations" @updateSeat="onClickChild"/>
        
    </div>
</template>

<script>
import Details from './Details'
import Content from './Content'
import Booking from './BookingDetails'

window.axios = require('axios')

export default {
    components: {
        Details,
        Content,
        Booking
    },
    data() {
        return {
            seats: '',
            available: '',
            employees: '',
            destinations: '',
            updateseat: {},
            
        }
    },
    mounted() {
        console.log('Component mounted.')
    },
    methods: {
        fetchSeatsAPI(){
            axios.get('http://localhost:8000/api/seats')
                .then(res => this.seats = res.data)
                .catch(err => console.log(err))
        },
        fetchEmployeesAPI(){
            axios.get('http://localhost:8000/api/employees')
                .then(res => this.employees = res.data)
                .catch(err => console.log(err))
        },
        fetchDestinationAPI(){
            axios.get('http://localhost:8000/api/destinations')
                .then(res => this.destinations = res.data)
                .catch(err => console.log(err))
        },
        onClickChild(values){
            this.updateseat = values;
            $.ajax({
                type: "GET",
                url: "api/seats/update",
                data: this.updateseat
            });
        }
    },
    created() {
        this.fetchSeatsAPI()
        this.fetchEmployeesAPI()
        this.fetchDestinationAPI()
    }
}
</script>