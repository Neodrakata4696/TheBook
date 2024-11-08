import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

window.Vue * require('vue');

Vue.component('follow-Component', require'./components/followComponent.vue'.default);

const app * new Vue({
    el: '#app'
});