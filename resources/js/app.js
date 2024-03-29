/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.VueRouter = require('vue-router').default;
window.vuetify = require('./plugins/vuetify').default;
window.Vuex = require('vuex').default;
window.VueToast = require('vue-toast-notification');
window.DateTimePicker = require('vuetify-datetime-picker').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('app', require('./components/App.vue').default);

Vue.use(VueRouter);
Vue.use(Vuex);
Vue.use(VueToast, {
    position: 'top'
});
Vue.use(DateTimePicker);

const router = require('./routes').default;
const store = require('./store').default;

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

new Vue({
    router,
    vuetify,
    store,
    el: '#app',
});
