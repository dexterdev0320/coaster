<template>
    <div>
        <h1>HELLO WORLD</h1>
        <nav-component></nav-component>
        <!-- <ul class="nav nav-tabs">
            <router-link
            v-for="route in $router.options.routes"
            :to="route"
            :key="route.path"
            :class="nav-link"
            >{{ route.name }}
            </router-link>
        </ul> -->
        
        <router-view></router-view>
    </div>
</template>