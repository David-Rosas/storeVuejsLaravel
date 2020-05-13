require('./bootstrap');

import Vue from 'vue';

const app = new Vue({
    el: '#app',
    data: {
        menu: 0
    }
});

Vue.component('categoria', require('./components/Categoria.vue').default);

Vue.component('producto', require('./components/Producto.vue').default);

Vue.component('proveedor', require('./components/Proveedor.vue').default);

Vue.component('cliente', require('./components/Cliente.vue').default);

Vue.component('role', require('./components/Role.vue').default);