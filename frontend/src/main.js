import Vue from 'vue'
import App from './App.vue'

import vuetify from './plugins/vuetify';

import router from './router'

import axios from 'axios'
import VueAxios from 'vue-axios'

Vue.config.productionTip = false

Vue.use(VueAxios, axios)

axios.defaults.baseURL = "https://vissini-grupo-a.herokuapp.com/api"

new Vue({
  router,
  vuetify,
  render: h => h(App)
}).$mount('#app')
