import Axios from "axios"
import foo from '@/configs'
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
  /**
   * Lấy danh sách phần tử
   */
  getList: async ({ commit }, { per_page = foo.PAGINATE.per_page, page = foo.PAGINATE.page, order_by = foo.PAGINATE.order_by, order_dir = foo.PAGINATE.order_dir, pagination = true }) => {
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
      commit('setLoading', false, { root: true })
      if(result.status === 200) {
        if(pagination === false) {
          commit('setList', {
            all: result.data.data,
            total: result.data.data.length
          })
        } else {
          commit('setList', {
            all: result.data.data,
            total: result.data.meta.total
          })
        }
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
  },
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