import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)
import axios from '@/plugins/axios'
import auth from './modules/auth'
import slider from './modules/slider'
import category from './modules/category'
import product from './modules/product'
import category_type from './modules/category_type'
import type from './modules/type'

const store = new Vuex.Store({
  strict: process.env.NODE_ENV !== 'production',
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
    slider,
    category,
    product,
    category_type,
    type
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