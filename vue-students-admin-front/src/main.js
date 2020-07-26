import Vue from 'vue'
import App from './App.vue'
import router from '@/router'
import '@fortawesome/fontawesome-free/css/all.css'
import '@fortawesome/fontawesome-free/js/all.js'
import 'spectre.css/dist/spectre.min.css'
import 'spectre.css/dist/spectre-icons.min.css'

Vue.config.productionTip = false

window.vue = Vue

new Vue({
  render: h => h(App),
    router,
}).$mount('#app')
