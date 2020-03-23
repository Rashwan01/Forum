require("./bootstrap")
window.Vue = require('vue');
window.axios = require('axios');
import Vuetify from 'vuetify';
Vue.use(Vuetify);

import VueSimplemde from 'vue-simplemde'
import md from "marked"
window.md = md;
import 'simplemde/dist/simplemde.min.css'
Vue.component('vue-simplemde', VueSimplemde)



window.EventBus = new Vue();
console.log(User.isLogin());
import User from "./helpers/user"
window.User = User 
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('toolbar', require('./components/toolbar.vue').default);
Vue.component('appFooter', require('./components/appFooter.vue').default);
Vue.component('appHome', require('./components/appHome.vue').default);
Vue.component('login', require('./components/authentication/login.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import router from "./router/index.js"
const app = new Vue({
  el: '#app',
  vuetify: new Vuetify(),
  router
});
