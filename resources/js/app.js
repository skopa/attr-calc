import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import Notifications from 'vue-notification'
import axios from 'axios';
import Vue from 'vue'
import App from './App.vue';
import routes from './routes';
import GoogleAuth from 'vue-google-oauth'
import BootstrapVue from 'bootstrap-vue'

require('./bootstrap');

window.Vue = require('vue');
window.env = {
    google_client_id: document.getElementsByName('google-client-id')[0].getAttribute('content'),
    csrf_token: document.getElementsByName('csrf-token')[0].getAttribute('content')
}

Vue.use(BootstrapVue);
Vue.use(VueRouter);
Vue.use(Notifications);
Vue.use(GoogleAuth, {client_id: window.env.google_client_id});
Vue.googleAuth().load().then();

const axiosInstance = axios.create({
    headers: {
        'X-CSRF-TOKEN': window.env.csrf_token,
        'Accept': 'application/json'
    }
});

const errorHandler = error => {
    Vue.notify({
        group: 'app',
        type: 'error',
        title: 'Error',
        text: error.message
    });

    return Promise.reject(error);
};

axiosInstance.interceptors.response.use(response => response, errorHandler);

Vue.use(VueAxios, axiosInstance);

const router = new VueRouter({mode: 'history', routes: routes});

new Vue(Vue.util.extend({router}, App)).$mount('#app');
