import Axios from "@/plugins/axios"

const URL = 'datatypes'

const state = {
	all: [],
	currItem: null
}

const getters = {
	getAll: state => {
		return state.all
	},
}

const actions = {
	/**
	 * Lấy danh sách phần tử
	 */
	getList: async ({ commit }) => {
		commit('setLoading', true, { root: true })
		try {
			let result = await Axios.get(`${URL}`)
			commit('setLoading', false, { root: true })
			if(result.status === 200) {
        commit('setList', result.data.data)
				return { flag: true, data: result.data }
			}
			return { flag: false }
		} catch (error) {
			console.log(error)
			return { flag: false }
		}
	},
	/**
	 * Lấy phần tử theo id
	 */
	getItemById: async ({ commit }, id) => {
		try {
			let result = await Axios.get(`${URL}/${id}`)
			if(result.status === 200) {
				return { flag: true, data: result.data }
			}
			return { flag: false }
		} catch (error) {
			console.log(error)
			return { flag: false }
		}
	},
}

const mutations = {
	setList: (state, data) => {
		state.all = data
	},
}

export default {
	state,
	getters,
	actions,
	mutations,
	namespaced: true
}