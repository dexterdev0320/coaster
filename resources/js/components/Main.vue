<template>
    <div class="container">
        <Nav v-bind:component="component" v-on:newComponent="updateComponent($event)"/>
        <component v-bind:is="component"></component>
    </div>
</template>

<script>
import Nav from './Navigation'
// import BookingIndex from './Booking/Index
import MondayBooking from './Monday/Index'
import SaturdayBooking from './SaturdayBooking'

export default {
    components: {
        Nav,
        // BookingIndex,
        MondayBooking,
        SaturdayBooking
    },
    data() {
        return {
            component: 'SaturdayBooking'
        }
    },
    mounted() {
        console.log('SaturdayBooking.')
    },
    methods: {
        updateComponent(newComponent) {
            if (newComponent === 'Saturday') {
                this.component = 'SaturdayBooking'
            }else{
                this.component = 'MondayBooking'
            }
        }
    }
}
</script>
