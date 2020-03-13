import Vue from '@/app'
import store from '@/store'
import moment from 'moment'
import foo from '@/configs'
const Helpers = {
	/**
	 * Lấy url đường dẫn ảnh
	 * @param {*} _controller 
	 * @param {*} _thumbnail 
	 */
	_getThumbnail(_controller, _thumbnail) {
		return `images/${_controller}/${_thumbnail}`
	},
	/**
	 * Format thời gian
	 * @param {*} _time 
	 * @param {*} _type 
	 */
	_dateFormat(_time, _type) {
		moment.locale('vi')
		return moment(_time).format(foo.TIME[_type])
	},
	/**
	 * Hiển thị trạng thái phần tử
	 * @param {*} _state 
	 */
	_showStatus(_state) {
		return foo.STATUS[_state].class
	},
	/**
	 * Thay đổi trạng thái phần tử
	 * @param {*} _controller 
	 * @param {*} _data 
	 */
	_changeStatus(_controller, _data) {
		const _this = Vue
		_this.$store.dispatch(`${_controller}/changeStatus`, _data)
		.then(res => {
			if(res.flag)
				_this.$fire(foo.NOTIFICATION.success.updated)
			else 
				_this.$fire(foo.NOTIFICATION.error)
		})
	},
	/**
	 * Hiển thị lỗi từ serve
	 * @param {*} _errors 
	 */
	_showErrors(_errors) {
		let xhtml = ''
		for(let i in _errors) {
			let error = _errors[i]
			xhtml += `<div style="font-size: 12px">${error[0]}</div>`
		}
		foo.NOTIFICATION.error.html = xhtml
		foo.NOTIFICATION.error.timer = 5000
		this.$fire(foo.NOTIFICATION.error)
	},
	/**
	 * Thẻ notag
	 * @param {*} _str 
	 */
	_notag(_str) {
		if(_str && typeof(_str) === 'string') {
			return _str.replace(/&/g, '&amp;').replace(/'/g,'&#x27;').replace(/\"/g, '&quot;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/\//g, '&#x2F;')
		}
	},
	/**
	 * Giới hạn update 1 hình ảnh (hiển thị)
	 * @param {*} isDisplay 
	 */
	_limitDisplayImage(isDisplay) {
		if(isDisplay) {
			document.querySelector('.el-upload.el-upload--picture-card').style = 'display: none'
		} else {
			document.querySelector('.el-upload.el-upload--picture-card').style = 'display: block'
		}
	}
}
export default Helpers