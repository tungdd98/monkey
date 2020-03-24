import axios from '@/plugins/axios'
const URL = 'auth'

const state = {
  user: null,
  token: null
}

const getters = {
  getUser(state) {
    return state.user
  },
  isLogin(state) {
    if(state.user && state.token)
      return true
    return false
  }
}

const actions = {
  /**
   * Đăng nhập
   * 
   * @param formdata user
   * @return response
   */
  async login({ commit, dispatch }, data) {
    try {
      let result = await axios.post(`${URL}/login`, data)
      if(result.status === 200) {
        dispatch('getUserLogin', result.data.token)
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
  /**
   * Lấy thông tin user đăng nhập
   * 
   * @param string token
   * @return response
   */
  async getUserLogin({ commit }, token) {
    commit('setToken', token)
    try {
      let result = await axios.get(`${URL}/users`, {
        headers: {
          'Authorization': `Bearer ${token}`
        }
      })
      if(result.status === 200) {
        commit('setUserLogin', result.data)
        return {
          flag: true,
          level: result.data.level
        }
      }
      return {
        flag: false
      }
    } catch (error) {
      console.log(error)
      commit('setToken', null)
      commit('setUserLogin', null)
      return {
        flag: false
      }
    }
  },
  /**
   * Kiểm tra user đã login hay chưa
   * 
   * @param void
   * @return response
   */
  async checkUserLogin({ commit, dispatch }) {
    try {
      let tokenLocal = localStorage.getItem('token')
      if(tokenLocal) {
        await dispatch('getUserLogin', tokenLocal)
        return {
          flag: true,
        }
      } else {
        return {
          flag: false
        }
      }
    } catch (error) {
      console.log(error)
      return {
        flag: false,
      }
    }
  },
  /**
   * Đăng xuất
   * 
   * @param void
   * @return response
   */
  async logout({ commit }) {
    try {
      let result = await axios.post(`${URL}/logout`)
      if(result.status === 200) {
        commit('setUserLogin', null)
        commit('setToken', null)
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
        flag: false,
      }
    }
  },
  /**
   * Đăng ký
   * 
   */
  async register({ commit, dispatch }, data) {
    try {
      let result = await axios.post('auth/register', data)
      console.log(result)
      if(result.status === 201) {
        dispatch('user/getList', {}, { root: true })
        return { flag: true }
      }
      return { flag: false }
    } catch (error) {
      console.log(error)
      return { flag: false, msg: error }
    }
  }
}

const mutations = {
  setToken(state, token) {
    state.token = token
  },
  setUserLogin(state, user) {
    state.user = user
  }
}

export default {
  state,
  getters,
  actions,
  mutations,
  namespaced: true
}