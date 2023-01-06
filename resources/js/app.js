/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue';
//import Vuex from 'vuex'

import store from './store/index';

import App from './components/App.vue';

//window.csrf_token = "{{ csrf_token() }}";
window.axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
};

import VueRouter from 'vue-router';
import router from './router';
//import App from './components/App';

//import LoginPanel from './components/LoginPanel';

//import GoogleMapsLoader from 'google-maps'



Vue.use(VueRouter);

const app = new Vue({
    el: '#app',
    render: h =>h(App),
    store: store,
    router
});
