const rules = {
  login: {
    email: [
      { required: true, message: 'Vui lòng nhập email đăng nhập', trigger: 'blur' },
    ],
    password: [
      { required: true, message: 'Vui lòng nhập mật khẩu đăng nhập', trigger: 'blur' }
    ]
  },
  title: [
    { required: true, message: 'Vui lòng nhập tiêu đề', trigger: 'blur' },
  ],
  thumbnail: [
    { required: true, message: 'Vui lòng tải lên hình ảnh', trigger: 'blur' },
  ],
  category: [
    { required: true, message: 'Vui lòng chọn danh mục', trigger: 'blur' },
  ],
  register: {
    name: [
      { required: true, message: 'Vui lòng nhập tên tài khoản', trigger: 'blur' },
    ],
    email: [
      { required: true, message: 'Vui lòng nhập email', trigger: 'blur' },
    ],
    password: [
      { required: true, message: 'Vui lòng nhập mật khẩu', trigger: 'blur' },
    ],
    phone: [
      { required: true, message: 'Vui lòng nhập số điện thoại', trigger: 'blur' },
    ],
    address: [
      { required: true, message: 'Vui lòng nhập địa chỉ', trigger: 'blur' },
    ]
  }
}
export default rules