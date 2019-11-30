import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import Notifications from 'vue-notification'
import axios from 'axios';
import App from './App.vue';
import Vue from 'vue'

import AttributesListComponent from "./components/Attributes/AttributesListComponent";
import ProjectsListComponent from "./components/projects/ProjectsListComponent";

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


const routes = [
    {
        name: 'home',
        path: '/',
        component: ProjectsListComponent
    },
    {
        name: 'attributes',
        path: '/attributes',
        component: AttributesListComponent
    },
    // {
    //     name: 'posts',
    //     path: '/posts',
    //     component: IndexComponent
    // },
    // {
    //     name: 'edit',
    //     path: '/edit/:id',
    //     component: EditComponent
    // }
];

const router = new VueRouter({mode: 'history', routes: routes});

new Vue(Vue.util.extend({router}, App)).$mount('#app');
