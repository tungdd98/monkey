<template>
    <el-container class="v-login">
        <div class="v-login-form">
            <h3>Đăng ký tài khoản</h3>
            <el-form
                :model="form"
                status-icon
                :ref="formName"
                label-width="120px"
                class=""
                :rules="rules"
            >
                <el-form-item label="Tên người dùng" prop="name">
                    <el-input
                        type="text"
                        v-model="form.name"
                        auto-complete="off"
                        placeholder="..."
                    ></el-input>
                </el-form-item>
                <el-form-item label="Email" prop="email">
                    <el-input
                        type="email"
                        v-model="form.email"
                        auto-complete="off"
                        placeholder="..."
                    ></el-input>
                </el-form-item>
                <el-form-item label="Mật khẩu" prop="password">
                    <el-input
                        type="password"
                        v-model="form.password"
                        auto-complete="off"
                        placeholder="..."
                    ></el-input>
                </el-form-item>
                <el-form-item label="Nhập lại mật khẩu">
                    <el-input
                        type="password"
                        v-model="form.repassword"
                        auto-complete="off"
                        placeholder="..."
                    ></el-input>
                </el-form-item>
                <div class="v-login-btn">
                    <el-button
                        type="primary"
                        @click.prevent="handleLogin(formName)"
                        >Đăng ký</el-button
                    >
                </div>
            </el-form>
            <div class="v-login-actions">
                <div class="register">
                    <router-link to="/login">Đăng nhập</router-link>
                </div>
            </div>
        </div>
    </el-container>
</template>
<script>
import { mapActions } from "vuex";
import foo from "@/configs";
export default {
    name: "register",
    data() {
        return {
            formName: "register",
            form: {
                name: "",
                email: "",
                password: "",
                repassword: ""
            },
            rules: foo.RULES.register
        };
    },
    methods: {
        ...mapActions("auth", ["register"]),
        handleLogin(formName) {
            this.$refs[formName].validate(valid => {
                if (valid) {
                    let formData = new FormData();
                    formData.append("email", this.form.email);
                    formData.append("password", this.form.password);
                    formData.append("name", this.form.name);
                    this.register(formData)
                        .then(res => {
                            if (res.flag) {
                                this.$fire(foo.NOTIFICATION.success.registed);
                                return true;
                            } else {
                                this.$fire(foo.NOTIFICATION.error);
                                return false;
                            }
                        })
                        .then(res => {
                            if (res) this.$router.push("/login");
                        });
                }
            });
        },
        test() {
            console.log("hihi");
        }
    }
};
</script>
<style></style>
