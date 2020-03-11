import Vue from 'vue'
import App from '@/App.vue'
import '@/plugins'
import router from '@/router.js'
import store from '@/store'
import Helpers from '@/helpers'

Vue.mixin({
  methods: Helpers
})

Vue.config.productionTip = false

new Vue({
  store,
  router,
  render: h => h(App)
}).$mount('#app')