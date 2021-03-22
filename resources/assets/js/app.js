
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import Vue from 'vue'
import moment from 'moment'
import VueRouter from 'vue-router'
import VueProgressBar from 'vue-progressbar'
import swal from 'sweetalert2'
window.swal = swal;
const Toast = swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', swal.stopTimer)
    toast.addEventListener('mouseleave', swal.resumeTimer)
  }
})
window.Toast = Toast;
window.Fire = new Vue();

Vue.use(VueProgressBar, {
  color: 'rgb(143, 255, 199)',
  failedColor: 'red',
  height: '2px'
})
import {Form, HasError, AlertError} from 'vform';
import { values } from 'lodash';
Vue.use(VueRouter)
window.Vue = require('vue');
window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
const routes = [
  { path: '/suppliers', component: require('./components/Suppliers.vue') },
  { path: '/products', component: require('./components/Products.vue') },
  { path: '/orders', component: require('./components/Orders.vue') },
    { path: '/dashboard', component: require('./components/Dashboard.vue') },
    { path: '/users', component: require('./components/Users.vue') },
    
{ path: '/profile', component: require('./components/Profile.vue') }
    
  ]

  const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
  })
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app',
    router
});
Vue.filter('textUp',function(value){
  return value.charAt(0).toUpperCase() + value.slice(1);
});
Vue.filter('customDate',function(currentDate){
  return moment(currentDate).format('MMMM Do YYYY, h:mm:ss a');
});