import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)
import axios from '@/plugins/axios'
import auth from './modules/auth'
import slider from './modules/slider'

const store = new Vuex.Store({
  state: {
    isLoading: false
  },
  getters: {},
  actions: {},
  mutations: {
    setLoading: (state, loading) => {
      state.isLoading = loading
    }
  },
  modules: {
    auth,
    slider
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