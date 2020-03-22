import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)
import axios from '@/plugins/axios'
import auth from './modules/auth'
import category from './modules/category'
import product from './modules/product'
import type from './modules/type'
import unit from './modules/unit'
import supplier from './modules/supplier'
import article from './modules/article'
import datatype from './modules/datatype'
import cart from './modules/cart'

const store = new Vuex.Store({
  strict: process.env.NODE_ENV !== 'production',
  state: {
    isLoading: false,
    pathBanner: '/tomita/images/bn-product.jpg'
  },
  getters: {
    getUrlBanner: state => {
      return state.pathBanner
    }
  },
  actions: {
  },
  mutations: {
    setLoading: (state, loading) => {
      state.isLoading = loading
    },
    setBanner: (state, pathBanner) => {
      state.pathBanner = pathBanner
    }
  },
  modules: {
    auth,
    category,
    product,
    type,
    article,
    unit,
    supplier,
    datatype,
    cart
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