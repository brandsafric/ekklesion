import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'

import 'bootstrap/scss/bootstrap.scss'
import 'bootstrap-vue/dist/bootstrap-vue.css'

// Custom general css
import './../css/app.scss';

import Alert from './components/Alert';

Vue.use(BootstrapVue);

new Vue({
    el: '#vue',
    components: {
        'uno-alert': Alert
    }
});

