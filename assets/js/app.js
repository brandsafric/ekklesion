import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'

import 'bootstrap/scss/bootstrap.scss'
import 'bootstrap-vue/dist/bootstrap-vue.css'

// Custom app css
import './../css/app.css';

Vue.use(BootstrapVue);

new Vue({
    el: '#vue'
});

