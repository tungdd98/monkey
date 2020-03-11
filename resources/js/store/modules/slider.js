import Axios from "axios"
import { paginate } from '@/configs'

const state = {
  all: [],
  total: 0
}

const getters = {

}

const actions = {
  
  getList: async ({ commit }) => {
    commit('setLoading', true, { root: true })
    try {
      let result = await Axios.get('api/sliders')
      commit('setLoading', false, { root: true })
      console.log(result)
    } catch (error) {
      console.log(error)
      return {
        flag: false
      }
    }
  }
}

const mutations = {

}

export default {
  state,
  getters,
  actions,
  mutations,
  namespaced: true
}