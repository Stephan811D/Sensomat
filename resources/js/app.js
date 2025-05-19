/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');


import { Form } from 'vform';
window.Form = Form;

/**
 * Vue Router
 */

import VueMeta from 'vue-meta'
import VueRouter from 'vue-router';
import routes from './routes';
import axios from 'axios';
import VueApexCharts from 'vue-apexcharts';

axios.defaults.withCredentials = true;
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
//axios.defaults.baseURL = 'https://sensomat.drogerie-elisabeth.at/api';
//axios.defaults.headers.common['Authorization'] = "Bearer " + 
//VueCookie.get('api_token');


Vue.use(VueMeta)
Vue.use(VueRouter);
Vue.use(VueApexCharts);

//Bootstrap
import { BootstrapVue, BootstrapVueIcons} from 'bootstrap-vue';
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(BootstrapVue);
Vue.use(BootstrapVueIcons);


Vue.component('navigation', require('./components/structure/Navigation.vue').default);
Vue.component('sidebar', require('./components/structure/Sidebar.vue').default);

//Vue.component('products', require('./components/Products').default);
Vue.component('apexchart', VueApexCharts);

const app = new Vue({
    el: '#app',
    router: new VueRouter(routes)
});
