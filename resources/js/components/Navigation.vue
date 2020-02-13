<template>
    <div class="row">
        <div class="col-lg-12 border-bottom border-primary">
            <ul class="nav justify-content-center">
                <li class="nav-item">
                <a class="nav-link active" v-on:click="$emit('newComponent', 'Saturday')" href="#">Saturday</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" v-on:click="$emit('newComponent', 'Monday')" href="#">Monday</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" v-on:click="$emit('newComponent', 'Feedback')" href="#">Feedback Form</a>
                </li>
            </ul>
        </div>
	</div>
</template>

<script>
export default {
    props: ['component'],
    mounted() {
        console.log(this.component)
    },
    data() {
        return {
            newcomponent: this.component
        }
    },
    methods: {
        changeComponent(){
            
        }
    }
}
</script>