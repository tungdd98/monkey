// Pagination
const pagi = {
  per_page: 5,
  page: 1,
  order_by: 'created_at',
  order_dir: 'desc'
}
// Notification config
const baseNoti = {
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 1500
}
let noti = {
  success: {
    ...baseNoti,
    type: 'success',
    title: 'Bạn đã thêm thành công!'
  },
  error: {
    ...baseNoti,
    type: 'error',
    title: 'Có lỗi xảy ra!'
  }
}
let confirm = {
  title: "Bạn có chắc chắn muốn xoá?",
  type: "warning",
  showCancelButton: true,
  confirmButtonText: "Có"
}
export { noti, confirm, pagi }