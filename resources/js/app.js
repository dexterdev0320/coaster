
require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';

Vue.use(VueRouter);

const Test = { template: '<div>Test</div>' };
const User = { template: '<div>User</div>' };

const routes = [
	{ path: '/test', component: require('./components/ExampleComponent.vue').default, name: 'Saturday' },
	{ path: '/user', component: require('./components/NavComponent.vue').default, name: 'Monday' },
	{ path: '/form/:user_id', component: require('./components/FormComponent.vue').default, name: 'Feedback Form' }
];

const router = new VueRouter ({
	routes,
	mode: 'history',
});

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('nav-component', require('./components/NavComponent.vue').default);
Vue.component('main-component', require('./components/MainComponent.vue').default);

const app = new Vue({
    el: '#app',
    router,
});
