import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)
import axios from '@/plugins/libs/axios'
import auth from './modules/auth'

const store = new Vuex.Store({
  state: {
    isLoading: false
  },
  getters: {},
  actions: {},
  mutations: {},
  modules: {
    auth
  }
})
store.subscribe((mutations) => {
  switch(mutations.type) {
    case 'auth/setToken':
      if(mutations.payload) {
        axios.defaults.headers.common['Authorization'] = `Bearer ${mutations.payload}`
        localStorage.setItem('token', mutations.payload)
      } else {
        axios.defaults.headers.common['Authorization'] = null
        localStorage.removeItem('token')
      }
    break;
  }
})
export default store