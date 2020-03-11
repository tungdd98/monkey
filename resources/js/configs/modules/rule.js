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
  ]
}
export default rules