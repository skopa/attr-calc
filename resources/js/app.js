import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import Notifications from 'vue-notification'
import axios from 'axios';
import Vue from 'vue'
import App from './App.vue';
import routes from './routes';

require('./bootstrap');

window.Vue = require('vue');

Vue.use(VueRouter);
Vue.use(Notifications);

const axiosInstance = axios.create({
    headers: {
        'X-CSRF-TOKEN': document.getElementsByName('csrf-token')[0].getAttribute('value'),
        'Accept': 'application/json'
    }
});

axiosInstance.interceptors.response.use(
    response => response,
    error => {
        Vue.notify({
            group: 'app',
            type: 'error',
            title: 'Error',
            text: error.message
        });

        return Promise.reject(error);
    }
);

Vue.use(VueAxios, axiosInstance);

const router = new VueRouter({mode: 'history', routes: routes});

new Vue(Vue.util.extend({router}, App)).$mount('#app');
