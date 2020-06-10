import Axios from "@/plugins/axios"
import foo from '@/configs'

const URL = 'articles'

const state = {
	per_page: foo.PAGINATE.per_page,
	order_by: foo.PAGINATE.order_by,
	order_dir: foo.PAGINATE.order_dir,
	page: foo.PAGINATE.page,
	all: [],
	total: 0,
	currItem: null
}

const getters = {
	getAll: state => {
		return state.all
	},
	getTotalList: state => {
		return state.total
	},
	getCurrItem: state => {
		return state.currItem
	},
	getFilter: state => {
		return {
			per_page: state.per_page,
			order_by: state.order_by,
			order_dir: state.order_dir,
			page: state.page,
		}
	},
}

const actions = {
	/**
	 * Lấy danh sách phần tử
	 */
	getList: async ({ commit }, { per_page = foo.PAGINATE.per_page, page = foo.PAGINATE.page, order_by = foo.PAGINATE.order_by, order_dir = foo.PAGINATE.order_dir, pagination = true }) => {
		commit('setLoading', true, { root: true })
		try {
			let config = {
				params: { per_page, page, order_by, order_dir, pagination }
			}
			let result = await Axios.get(`${URL}`, config)
			commit('setLoading', false, { root: true })
			if (result.status === 200) {
				if (!pagination) {
					commit('setList', {
						all: result.data.data,
						total: result.data.data.length
					})
				} else {
					commit('setList', {
						all: result.data.data.data,
						total: result.data.data.total
					})
					commit('setPaginate', { per_page, page, order_by, order_dir })
				}
				return { flag: true }
			}
			return { flag: false }
		} catch (error) {
			console.log(error)
			return { flag: false }
		}
	},
	/**
	 * Thay đổi trạng thái phần tử
	 */
	changeStatus: async ({ commit, dispatch }, data) => {
		try {
			data.status = data.status === 1 ? 0 : 1
			let result = await Axios.patch(`${URL}/${data.id}`, data)
			if (result.status === 200) {
				return { flag: true }
			}
		} catch (error) {
			console.log(error)
			return { flag: false }
		}
	},
	/**
	 * Xoá phần tử
	 */
	deleteItem: async ({ commit, dispatch }, data) => {
		try {
			let result = await Axios.delete(`${URL}/${data.id}`)
			if (result.status === 200) {
				return { flag: true }
			}
			return { flag: false }
		} catch (error) {
			console.log(error)
			return { flag: false }
		}
	},
	/**
	 * Thêm phần tử
	 */
	createItem: async ({ commit, dispatch }, data) => {
		try {
			let result = await Axios.post(`${URL}`, data)
			if (result.status === 200) {
				dispatch('getList', {})
				return { flag: true }
			}
			return { flag: false }
		} catch (error) {
			return { flag: false, msg: error }
		}
	},
	/**
	 * Lấy phần tử theo id
	 */
	getItemById: async ({ commit }, id) => {
		try {
			let result = await Axios.get(`${URL}/${id}`)
			if (result.status === 200) {
				commit('setCurrItem', result.data.data)
				return { flag: true }
			}
			return { flag: false }
		} catch (error) {
			console.log(error)
			return { flag: false }
		}
	},
	/**
	 * Update phần tử
	 */
	updateItem: async ({ commit, dispatch }, data) => {
		try {
			let result = await Axios.post(`${URL}/${data.id}`, data)
			if (result.status === 200) {
				dispatch('getList', {})
				return { flag: true }
			}
			return { flag: false }
		} catch (error) {
			console.log(error)
			return { flag: false, msg: error }
		}
	},
	getListTomita: async ({ commit, dispatch }) => {
		commit('setLoadingHome', true, { root: true })
		try {
			const res = await Axios.get(`tomita/${URL}`)
			commit('setLoadingHome', false, { root: true })
			return res.status === 200 ? res.data : null
		} catch (error) {
			return null
		}
	}
}

const mutations = {
	setList: (state, { all, total }) => {
		state.all = all
		state.total = total
	},
	setCurrItem: (state, data) => {
		state.currItem = data
	},
	setPaginate: (state, { per_page, page, order_by, order_dir }) => {
		state.per_page = per_page
		state.page = page
		state.order_by = order_by
		state.order_dir = order_dir
	}
}

export default {
	state,
	getters,
	actions,
	mutations,
	namespaced: true
}