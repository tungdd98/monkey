import moment from 'moment'
const Helpers = {
  getThumbnail(controller, thumbnail) {
    return `images/${controller}/${thumbnail}`
  },
  showMsg(str) {
    return str.toLowerCase()
  },
  dateFormat(time, type) {
    moment.locale('vi')
    return moment(time).format(type)
  }
}
export default Helpers