import axios from '@/plugins/axios'
const URL = 'cart'
import Vue from 'vue'
import foo from '@/configs'

const state = {
  all: [],
  totalQuantity: 0,
  totalMoney: 0
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
  }
}

export default {
  state,
  getters,
  actions,
  mutations,
  namespaced: true
}