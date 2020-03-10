const rules = {
  login: {
    email: [
      { required: true, message: 'Vui lòng nhập email đăng nhập', trigger: 'blur' },
    ],
    password: [
      { required: true, message: 'Vui lòng nhập mật khẩu đăng nhập', trigger: 'blur' }
    ]
  }
}
export default rules