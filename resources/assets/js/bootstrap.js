import axios from 'axios';
import Vue from 'vue';
import VueRouter from 'vue-router';
import Form from './utilities/Form';
import Auth from './utilities/Auth';
import jQuery from 'jquery';
import Hammer from 'hammerjs';

window.Vue = Vue;
window.axios = axios;
window.$ = window.jQuery = jQuery;
window.Style = {hero: ''};
window.Hammer = Hammer;

Vue.use(VueRouter);

window.axios.defaults.headers.common = {
    'X-CSRF-TOKEN': window.Laravel.csrfToken,
    'X-Requested-With': 'XMLHttpRequest'
};

window.Form = Form;
window.Auth = new Auth(User);
