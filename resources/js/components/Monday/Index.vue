<template>
    <div>
        <Details/>
        <Content/>
        <Booking/>
    </div>
</template>

<script>
import Details from './HeaderDetails'
import Content from './Content'
import Booking from './BookingDetails'

export default {
    components: {
        Details,
        Content,
        Booking
    },
    mounted() {
        console.log('Component mounted.')
    }
}
</script>