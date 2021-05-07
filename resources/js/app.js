/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue').default;
// import {Form, HasError, AlertError} from 'vform'
import Swal from 'sweetalert2'
import Form from 'vform'

// Vue.component(Errors.name, Errors)
// Vue.component(AlertError.name, AlertError)
Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('product-component', require('./components/ProductComponent.vue').default);

window.Swal = Swal;
window.Form = Form;

const app = new Vue({
    el: '#app',
});
