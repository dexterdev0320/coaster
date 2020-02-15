<template>
    <div class="container">
        <Nav v-bind:component="component" v-on:newComponent="updateComponent($event)"/>
        <component v-bind:is="component" :test="test"></component>
    </div>
</template>

<script>
import Nav from './Navigation'
// import BookingIndex from './Booking/Index
import MondayBooking from './MondayBooking'
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
            component: 'SaturdayBooking',
            test: undefined,
        }
    },
    mounted() {
        console.log('SaturdayBooking.')
    },
    methods: {
        updateComponent(newComponent) {
            if (newComponent === 'Saturday') {
                this.component = 'SaturdayBooking'
                this.test = this.component
            }else{
                this.component = 'MondayBooking'
                this.test = this.component
            }
        }
    }
}
</script>
