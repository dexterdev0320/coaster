<template>
		<ul class="nav nav-tabs">
			<li class="nav-item">
			<router-link to="/test" class="nav-link">Saturday</router-link>
		</li>
		<li class="nav-item">
			<router-link to="/user" class="nav-link">Monday</router-link>
		</li>
			<li class="nav-item">
				<router-link to="/form/:user_id" class="nav-link">Feedback Form</router-link>
			</li>
		</ul>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
