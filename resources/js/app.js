require('./bootstrap');

import Vue from 'vue';

Vue.component('categoria', require('./components/Categoria.vue').default);
const app = new Vue({
    el: '#app',
    data: {
        menu: 0
    }
});