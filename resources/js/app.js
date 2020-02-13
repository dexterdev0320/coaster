
require('./bootstrap');

window.Vue = require('vue');
window.axios = require('axios');
Vue.component('main-component', require('./components/Main.vue').default);

const app = new Vue({
    el: '#app',
    
});
