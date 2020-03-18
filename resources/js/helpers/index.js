import moment from 'moment'
import foo from '@/configs'
const Helpers = {
	/**
	 * Lấy url đường dẫn ảnh
	 * @param {*} controller 
	 * @param {*} thumbnail 
	 */
	_getThumbnail(controller, thumbnail) {
		return `/images/${controller}/${thumbnail}`
	},
	/**
	 * Format thời gian
	 * @param {*} time 
	 * @param {*} type 
	 */
	_dateFormat(time, type) {
		moment.locale('vi')
		return moment(time).format(foo.TIME[type])
	},
	/**
	 * Hiển thị trạng thái phần tử
	 * @param {*} state 
	 */
	_showStatus(state) {
		return foo.STATUS[state].class
	},
	/**
	 * Hiển thị lỗi từ serve
	 * @param {*} errors 
	 */
	_showErrors(errors) {
		let xhtml = ''
		for(let i in errors) {
			let error = errors[i]
			xhtml += `<div style="font-size: 12px">${error[0]}</div>`
		}
		foo.NOTIFICATION.error.html = xhtml
		foo.NOTIFICATION.error.timer = 5000
		this.$fire(foo.NOTIFICATION.error)
	},
	/**
	 * Thẻ notag
	 * @param {*} str 
	 */
	_notag(str) {
		if(str && typeof(str) === 'string') {
			return str.replace(/&/g, '&amp;').replace(/'/g,'&#x27;').replace(/\"/g, '&quot;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/\//g, '&#x2F;')
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
	},
	/**
	 * Định dạng tiền tệ
	 * @param {*} number
	 */
	_formatCurrency(number) {
		if(number)
			return new Intl.NumberFormat(foo.CURRENCY.VN.type, { style: 'currency', currency: foo.CURRENCY.VN.currency }).format(number)
		return null
	},
	/**
	 * Loại bỏ phần tử lặp trong mảng
	 * @param {*} arr
	 */
	_deduplicate(arrStart, arrFilter) {
		return arrStart.filter(value => arrFilter.indexOf(value) === -1)
	}
}
export default Helpers