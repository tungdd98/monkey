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
									<a class="nav-link active" data-toggle="tab" href="#login">Đăng nhập</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#register">Đăng ký</a>
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
													<input class="hidden" type="checkbox" name />
													<i></i>
													<span>Ghi nhớ đăng nhập</span>
												</label>
											</div>
											<a href title class="forget-acc">Quên mật khẩu</a>
										</div>
										<div class="btn-login">
											<button type="button" class="btn" @click.prevent="handleLogin">Đăng nhập</button>
										</div>
										<div class="other-ac">
											<div class="lb-or">
												<span>Hoặc</span>
											</div>
											<ul>
												<li>
													<a href title class="smooth">
														<i class="social_facebook"></i>
														<span>Đăng nhập qua Facebook</span>
													</a>
												</li>
												<li>
													<a href title class="smooth">
														<i class="social_googleplus"></i>
														<span>Đăng nhập qua Google+</span>
													</a>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<div id="register" class="tab-pane fade">
									<div class="fr-login">
										<div class="form-group">
											<label for>Họ và tên</label>
											<input type="text" class="form-control" placeholder="Nhập tên tài khoản" />
										</div>
										<div class="form-group">
											<label for>Email</label>
											<input type="email" class="form-control" placeholder="Địa chỉ email" />
										</div>
										<div class="form-group">
											<label for>Mật khẩu</label>
											<input type="password" class="form-control" placeholder="Nhập mật khẩu" />
										</div>
										<div class="form-group">
											<label for>Nhập lại mật khẩu</label>
											<input type="password" class="form-control" placeholder="Nhập lại mật khẩu" />
										</div>
										<div class="btn-login">
											<button type="button" class="btn">Đăng ký</button>
										</div>
										<div class="other-ac">
											<div class="lb-or">
												<span>Hoặc</span>
											</div>
											<ul>
												<li>
													<a href title class="smooth">
														<i class="social_facebook"></i>
														<span>Đăng nhập qua Facebook</span>
													</a>
												</li>
												<li>
													<a href title class="smooth">
														<i class="social_googleplus"></i>
														<span>Đăng nhập qua Google+</span>
													</a>
												</li>
											</ul>
										</div>
									</div>
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
			isClosed: false
		};
	},
	computed: {
		...mapGetters({
			user: "auth/getUser"
		})
	},
	methods: {
		...mapActions("auth", ["login"]),
		handleLogin() {
			let formData = new FormData();
			formData.append("email", this.formLogin.email);
			formData.append("password", this.formLogin.password);
			this.login(formData).then(res => {
				if (res.flag) {
          this.$fire(foo.NOTIFICATION.success.logined);
					document.querySelector('.modal-backdrop').style = 'display: none'
					document.querySelector('body').style = 'overflow: auto !important'
				} else {
					this.$fire(foo.NOTIFICATION.error);
				}
			});
		}
	}
};
</script>
<style>
</style>