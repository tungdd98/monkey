<template>
    <div v-if="!user">
        <div class="modal popup-login popup-primary fade" id="pu-login">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="icon_close"></i>
                    </button>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="tabs-login">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a
                                        class="nav-link active"
                                        data-toggle="tab"
                                        href="#login"
                                        >Đăng nhập</a
                                    >
                                </li>
                                <li class="nav-item">
                                    <a
                                        class="nav-link"
                                        data-toggle="tab"
                                        href="#register"
                                        >Đăng ký</a
                                    >
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div id="login" class="tab-pane active">
                                    <div class="fr-login">
                                        <div class="form-group">
                                            <label for>Email</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                placeholder="Nhập địa chỉ email"
                                                v-model="formLogin.email"
                                            />
                                        </div>
                                        <div class="form-group">
                                            <label for>Mật khẩu</label>
                                            <input
                                                type="password"
                                                class="form-control"
                                                placeholder="Nhập mật khẩu của bạn"
                                                v-model="formLogin.password"
                                            />
                                        </div>
                                        <div class="qmk">
                                            <div class="save-acc">
                                                <label class="i-check">
                                                    <input
                                                        class="hidden"
                                                        type="checkbox"
                                                        name
                                                    />
                                                    <i></i>
                                                    <span
                                                        >Ghi nhớ đăng nhập</span
                                                    >
                                                </label>
                                            </div>
                                            <a href title class="forget-acc"
                                                >Quên mật khẩu</a
                                            >
                                        </div>
                                        <div class="btn-login">
                                            <button
                                                type="button"
                                                class="btn"
                                                @click.prevent="handleLogin"
                                            >
                                                Đăng nhập
                                            </button>
                                        </div>
                                        <div class="other-ac">
                                            <div class="lb-or">
                                                <span>Hoặc</span>
                                            </div>
                                            <ul>
                                                <li>
                                                    <a
                                                        href
                                                        title
                                                        class="smooth"
                                                    >
                                                        <i
                                                            class="social_facebook"
                                                        ></i>
                                                        <span
                                                            >Đăng nhập qua
                                                            Facebook</span
                                                        >
                                                    </a>
                                                </li>
                                                <li>
                                                    <a
                                                        href
                                                        title
                                                        class="smooth"
                                                    >
                                                        <i
                                                            class="social_googleplus"
                                                        ></i>
                                                        <span
                                                            >Đăng nhập qua
                                                            Google+</span
                                                        >
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div id="register" class="tab-pane fade">
                                    <el-container class="v-login">
                                        <div
                                            class=""
                                            style="max-width: 600px; width: 100%"
                                        >
                                            <el-form
                                                :model="form"
                                                status-icon
                                                :ref="formName"
                                                label-width="140px"
                                                class=""
                                                :rules="rules"
                                            >
                                                <el-form-item
                                                    label="Tên người dùng"
                                                    prop="name"
                                                >
                                                    <el-input
                                                        type="text"
                                                        v-model="form.name"
                                                        auto-complete="off"
                                                        placeholder="..."
                                                    ></el-input>
                                                </el-form-item>
                                                <el-form-item
                                                    label="Email"
                                                    prop="email"
                                                >
                                                    <el-input
                                                        type="email"
                                                        v-model="form.email"
                                                        auto-complete="off"
                                                        placeholder="..."
                                                    ></el-input>
                                                </el-form-item>
                                                <el-form-item
                                                    label="Mật khẩu"
                                                    prop="password"
                                                >
                                                    <el-input
                                                        type="password"
                                                        v-model="form.password"
                                                        auto-complete="off"
                                                        placeholder="..."
                                                    ></el-input>
                                                </el-form-item>
                                                <el-form-item
                                                    label="Nhập lại mật khẩu"
                                                >
                                                    <el-input
                                                        type="password"
                                                        v-model="
                                                            form.repassword
                                                        "
                                                        auto-complete="off"
                                                        placeholder="..."
                                                    ></el-input>
                                                </el-form-item>
                                                <div class="v-login-btn">
                                                    <el-button
                                                        type="danger"
                                                        @click.prevent="
                                                            handleLogin(
                                                                formName
                                                            )
                                                        "
                                                        >Đăng ký</el-button
                                                    >
                                                </div>
                                            </el-form>
                                        </div>
                                    </el-container>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapActions, mapGetters } from "vuex";
import foo from "@/configs";
export default {
    data() {
        return {
            formLogin: {
                email: "admin@gmail.com",
                password: "123456"
            },
            isClosed: false,
            form: {
                name: "",
                email: "",
                password: "",
                repassword: ""
            },
            rules: foo.RULES.register,
            formName: "register"
        };
    },
    computed: {
        ...mapGetters({
            user: "auth/getUser"
        })
    },
    methods: {
        ...mapActions("auth", ["login", "register"]),
        handleLogin() {
            let formData = new FormData();
            formData.append("email", this.formLogin.email);
            formData.append("password", this.formLogin.password);
            this.login(formData).then(res => {
                if (res.flag) {
                    this.$fire(foo.NOTIFICATION.success.logined);
                    document.querySelector(".modal-backdrop").style =
                        "display: none";
                    document.querySelector("body").style =
                        "overflow: auto !important";
                } else {
                    this.$fire(foo.NOTIFICATION.error);
                }
            });
        },
        handleRegister(formName) {
            this.$refs[formName].validate(valid => {
                if (valid) {
                    let formData = new FormData();
                    formData.append("email", this.form.email);
                    formData.append("password", this.form.password);
                    formData.append("name", this.form.name);
                    this.register(formData).then(res => {
                        if (res.flag) {
                            this.$fire(foo.NOTIFICATION.success.registed);
                            return true;
                        } else {
                            this.$fire(foo.NOTIFICATION.error);
                            return false;
                        }
                    });
                }
            });
        }
    }
};
</script>
<style></style>
