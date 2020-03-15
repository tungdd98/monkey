const base = {
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 1500
}
const notification = {
  success: {
    created: { ...base, type: 'success', title: 'Thêm mới thành công!' },
    updated: { ...base, type: 'success', title: 'Cập nhật thành công!' },
    deleted: { ...base, type: 'success', title: 'Xoá thành công!' },
    logined: { ...base, type: 'success', title: 'Đăng nhập thành công!' }
  },
  error: { ...base, type: 'error', title: 'Có lỗi xảy ra' },
  confirm: {
    deleted: { type: 'warning', title: 'Bạn có chắc chắn muốn xoá?', showCancelButton: true, confirmButtonText: 'Có' }
  }
}
export default notification