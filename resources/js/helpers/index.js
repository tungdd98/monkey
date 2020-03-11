import moment from 'moment'
import { status, time } from '@/configs'
const Helpers = {
  getThumbnail(_controller, _thumbnail) {
    return `images/${_controller}/${_thumbnail}`
  },
  showMsg(_str) {
    return _str.toLowerCase()
  },
  dateFormat(_time, _type) {
    moment.locale('vi')
    return moment(_time).format(time[_type])
  },
  showStatus(_state) {
    return status[_state].class
  }
}
export default Helpers