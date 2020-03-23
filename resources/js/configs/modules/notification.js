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
    logined: { ...base, type: 'success', title: 'Đăng nhập thành công!' },
    registed: { ...base, type: 'success', title: 'Đăng ký thành công!' },
    addCart: { ...base, type: 'success', title: 'Đơn hàng được gửi đi thành công!' },
  },
  error: { ...base, type: 'error', title: 'Có lỗi xảy ra' },
  confirm: {
    deleted: { type: 'warning', title: 'Bạn có chắc chắn muốn xoá?', showCancelButton: true, confirmButtonText: 'Có' },
    addCart: { type: 'success', title: 'Xác nhận hoàn tất đơn hàng?', showCancelButton: true, confirmButtonText: 'Đồng ý' }
  },
  outOfStock: { ...base, type: 'error', title: 'Sản phẩm đã hết hàng' },
  addSuccess: { ...base, type: 'success', title: 'Sản phẩm đã thêm vào giỏ'},
  deleteSuccess: { ...base, type: 'success', title: 'Đã xoá sản phẩm khỏi giỏ'}
}
export default notification