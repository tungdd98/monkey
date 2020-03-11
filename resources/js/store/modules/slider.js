import Axios from "axios"
import { paginate } from '@/configs'

const state = {
  all: [],
  total: 0
}

const getters = {
  getAll: state => {
    return state.all
  },
  getTotalList: state => {
    return state.total
  }
}
   
const actions = {
  getList: async ({ commit }, { per_page = paginate.per_page, page = paginate.page, order_by = paginate.order_by, order_dir = paginate.order_dir }, pagination = false) => {
    commit('setLoading', true, { root: true })
    try {
      let config = {
        params: {
          per_page,
          page,
          order_by,
          order_dir,
          pagination
        }
      }
      let result = await Axios.get('api/sliders', config)
      console.log(result)
      commit('setLoading', false, { root: true })
      if(result.status === 200) {
        commit('setList', {
          all: result.data.data,
          total: result.data.meta.total
        }) 
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
  setList: (state, { all, total }) => {
    state.all = all
    state.total = total
  }
}

export default {
  state,
  getters,
  actions,
  mutations,
  namespaced: true
}