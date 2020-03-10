import VueRouter from 'vue-router'

// Vue.use(require('vue-moment'));
window.Vue = require('vue');
window.axios = require('axios');


Vue.use(VueRouter);
require('./bootstrap');

Vue.component('main-upd', require('./components/MainComponent.vue').default);
Vue.component('destination', require('./components/Destination/DestinationComponent.vue').default);
Vue.component('syncdavao', require('./components/SyncDavao.vue').default);
Vue.component('syncagusan', require('./components/SyncAgusan.vue').default);
Vue.component('addvisitor', require('./components/Visitor/VisitorComponent.vue').default);
Vue.component('employees-component', require('./components/Employee/EmployeeComponent.vue').default);

const app = new Vue({
    el: '#app',
    model: 'history'
});
