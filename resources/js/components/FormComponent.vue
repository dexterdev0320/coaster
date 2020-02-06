<template>
<div class="row">
    <div class="col">
        {{ $router.params.user_id }}
    </div>
</div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>