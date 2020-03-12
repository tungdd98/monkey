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
  }
}
export default Helpers