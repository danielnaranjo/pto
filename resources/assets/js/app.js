
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.Bus = new Vue();
Vue.use(require('vue-moment'));
Vue.use(require('moment/locale/es'));
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('ultimos', require('./components/Ultimos.vue'));
// Personalizados
Vue.component('usuarios', require('./components/Usuarios.vue'));
Vue.component('mensajes', require('./components/Mensajes.vue'));
Vue.component('chat', require('./components/Chat.vue'));
//https://github.com/viraj-khatavkar/group-chat-app-laravel-pusher/blob/master/resources/assets/js/app.js
Vue.component('groups', require('./components/Groups.vue'));
Vue.component('create-group', require('./components/CreateGroup.vue'));
Vue.component('group-chat', require('./components/GroupChat.vue'));

const app = new Vue({
    el: '#app'
});
