import axios from '@/plugins/axios'
const URL = 'cart'
import Vue from 'vue'
import foo from '@/configs'

const state = {
  all: [],
  totalQuantity: 0,
  totalMoney: 0,
  customer: null
}

const getters = {
  getCart: state => {
    const totalQuantity = state.all.reduce((total, item) => total + item.quantity, 0)
    const totalMoney = state.all.reduce((total, item) => total + item.product.price * item.quantity, 0)
    return {
      all: state.all,
      totalQuantity: totalQuantity,
      totalMoney: totalMoney
    }
  },
  getCustomer: state => {
    if(state.customer) {
      return state.customer
    }
    return null
  }
}

const actions = {
  /**
   * Thay đổi số lượng sản phẩm trong giỏ
   */
  changeProductToCart: ({ state, commit }, { product, quantity }) => {
    if(product.quantity > 0) {
      const cartItem = state.all.find(item => item.product.id === product.id)
      if(!cartItem) {
        commit('setProductToCart', { product, quantity })
      } else {
        commit('setItemQuantity', { cartItem, quantity })
      }
      if(quantity < 0) {
        Vue.fire(foo.NOTIFICATION.deleteSuccess)
      } else {
        Vue.fire(foo.NOTIFICATION.addSuccess)
      }
      commit('product/setProductQuantity', { id: product.id, quantity }, { root: true })
    } else {
      Vue.fire(foo.NOTIFICATION.outOfStock)
    }
  },
  /**
   * Xoá sản phẩm khỏi giỏ
   */
  deleteProductOutCart: ({ state, commit }, cartItem) => {
    const index = state.all.findIndex(item => item.id === cartItem.product.id)
    commit('deleteProduct', index)
    commit('product/setProductQuantity', { id: cartItem.product.id, quantity: -cartItem.quantity }, { root: true })
    Vue.fire(foo.NOTIFICATION.deleteSuccess)
  },
  /**
   * Thêm giỏ hàng vào csdl
   */
  addCart: async ({ commit }, data) => {
    try {
      let result = await axios.post('tomita/carts', data)
      if(result.status === 201) {
        commit('setNullCart')
        return { flag: true }
      }
      return { flag: false }
    } catch (error) {
      console.log(error)
      return { flag: false }
    }
  },
  addCustomer: async ({ commit }, data) => {
    try {
      commit('saveCustomer', data)
      return { flag: true }
    } catch (error) {
      console.log(error)
    }
  }
}

const mutations = {
  setProductToCart: (state, { product, quantity }) => {
    state.all.push({
      product,
      quantity
    })
  },
  setItemQuantity: (state, { cartItem, quantity }) => {
    const item = state.all.find(item => item.product.id === cartItem.product.id)
    item.quantity += quantity
  },
  deleteProduct: (state, index) => {
    state.all.splice(index, 1)
  },
  saveCustomer: (state, data) => {
    state.customer = data
  },
  setNullCart: state => {
    state.all = []
    state.totalMoney = 0
    state.totalQuantity = 0
  }
}

export default {
  state,
  getters,
  actions,
  mutations,
  namespaced: true
}