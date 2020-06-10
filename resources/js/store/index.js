import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)
import axios from '@/plugins/axios'
import auth from './modules/auth'
import user from './modules/user'
import category from './modules/category'
import product from './modules/product'
import unit from './modules/unit'
import supplier from './modules/supplier'
import article from './modules/article'
import datatype from './modules/datatype'
import order from './modules/order'
import cart from './modules/cart'

const store = new Vuex.Store({
  strict: process.env.NODE_ENV !== 'production',
  state: {
    isLoading: false,
    isLoadingHome: false,
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
    },
    setLoadingHome: (state, loading) => {
      state.isLoadingHome = loading
    }
  },
  modules: {
    auth,
    category,
    product,
    article,
    unit,
    supplier,
    datatype,
    cart,
    user,
    order
  }
})
store.subscribe((mutations) => {
  switch (mutations.type) {
    case 'auth/setToken':
      if (mutations.payload) {
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