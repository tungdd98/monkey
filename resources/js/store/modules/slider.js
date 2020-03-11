import Axios from "axios"
import { paginate } from '@/configs'

const state = {
  all: [],
  total: 0
}

const getters = {
  getAll: state => {
    return state.all
  }
}
   
const actions = {
  getList: async ({ commit }) => {
    commit('setLoading', true, { root: true })
    try {
      let result = await Axios.get('api/sliders')
      commit('setLoading', false, { root: true })
      if(result.status === 200) {
        commit('setList', result.data.data) 
        return {
          flag: true
        }
      }
      return {
        flag: false
      }
    } catch (error) {
      console.log(error)
      return {
        flag: false
      }
    }
  }
}

const mutations = {
  setList: (state, data) => {
    state.all = data
  }
}

export default {
  state,
  getters,
  actions,
  mutations,
  namespaced: true
}