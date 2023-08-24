/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';

import { createRouter, createWebHistory } from "vue-router"


/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */
const routeInfos = [
    {
        path : "/register",
        component : RegisterComponent
    },
    {
        path : "/login",
        component : loginComponent
    },
    {
        path : "/booking",
        name : "booking",
        component : BookingComponent
    }
];

const router = createRouter({
    history : createWebHistory(),
    routes : routeInfos
});

const app = createApp({}).use(router);


import RegisterComponent from './components/RegisterComponent.vue';
import loginComponent from './components/LoginComponent.vue';
import BookingComponent from './components/BookingComponent.vue';

import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

app.component('register-component', RegisterComponent);
app.component('booking-component', BookingComponent);
app.component('login-component', loginComponent);
app.component('Datepicker', VueDatePicker);




/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount('#app');
