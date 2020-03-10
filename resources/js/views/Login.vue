<template>
  <el-container class="v-login">
    <div class="v-login-form">
      <h3>Đăng nhập</h3>
      <el-form :model="form" status-icon :ref="formName" label-width="120px" class="" :rules="rules">
        <el-form-item label="Email" prop="email">
          <el-input type="email" v-model="form.email" auto-complete="off" placeholder="..."></el-input>
        </el-form-item>
        <el-form-item label="Mật khẩu" prop="password">
          <el-input type="password" v-model="form.password" auto-complete="off" placeholder="..."></el-input>
        </el-form-item>
        <div class="v-login-btn">
          <el-button type="primary" @click.prevent="handleLogin(formName)">Đăng nhập</el-button>
        </div>
      </el-form>
      <div class="v-login-actions">
        <div class="register">
          <router-link to="/register">Đăng ký</router-link>
        </div>
      </div>
    </div>
  </el-container>
</template>
<script>
import { mapActions } from 'vuex'
import { noti } from '@/constraint'
export default {
  name: 'login',
  data() {
    return {
      formName: 'login',
      form: {
        email: 'admin@gmail.com',
        password: '123456'
      },
      rules: {
        email: [
          { required: true, message: 'Vui lòng nhập email đăng nhập', trigger: 'blur' }
        ],
        password: [
          { required: true, message: 'Vui lòng nhập mật khẩu đăng nhập', trigger: 'blur' }
        ],
      }
    }
  },
  methods: {
    ...mapActions('auth', ['login']),
    handleLogin(formName) {
      this.$refs[formName].validate(valid => {
        if(valid) {
          let formData = new FormData()
          formData.append('email', this.form.email)
          formData.append('password', this.form.password)
          this.login(formData)
          .then(res => {
            if(res.flag) {
              noti.success.title = 'Đăng nhập thành công'
              this.$fire(noti.success)
              return true
            } else {
              noti.error.title = 'Đăng nhập thất bại'
              this.$fire(noti.error)
              return false
            }
          })
          .then(res => {
            if(res)
              this.$router.push('/admin')
          })
        }
      })
    }
  }
}
</script>
<style>
</style>