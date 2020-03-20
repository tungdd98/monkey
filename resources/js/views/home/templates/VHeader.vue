<template>
	<header>
		<div class="container">
			<div class="wrap-head">
				<nav class="d-nav v1">
					<div class="logo-mb">
						<a href="index.html">
							<img src="images/logo.png" />
						</a>
					</div>
					<ul>
						<li class="active">
							<router-link to="/" class="smooth">Trang chủ</router-link>
						</li>
						<li>
							<a class="smooth" href="product.html" title>
								Sản phẩm
								<i class="arrow_triangle-down"></i>
							</a>
							<ul>
								<li class="active">
									<a class="smooth" href="#" title>Thực phẩm tươi sống</a>
								</li>
								<li>
									<a class="smooth" href="#" title>Hoa quả</a>
								</li>
								<li>
									<a class="smooth" href="#" title>Đồ khô</a>
								</li>
								<li>
									<a class="smooth" href="#" title>Gia vị</a>
								</li>
								<li>
									<a class="smooth" href="#" title>Hóa mỹ phẩm hữu cơ</a>
								</li>
								<li>
									<a class="smooth" href="#" title>Bánh kẹo</a>
								</li>
								<li>
									<a class="smooth" href="#" title>Đồ gia dụng</a>
								</li>
							</ul>
						</li>
						<li>
							<a class="smooth" href="promotion.html" title>khuyến mãi</a>
						</li>
						<li>
							<a class="smooth" href="#" title>về chúng tôi</a>
						</li>
					</ul>
				</nav>
				<a href="index.html" class="logo">
					<img src="images/logo.png" alt />
				</a>
				<div class="head-right">
					<nav class="d-nav">
						<ul>
							<li>
								<router-link to="/faq" class="smooth">Hỗ trợ</router-link>
							</li>
							<li>
								<a class="smooth" href="news.html" title>tin tức</a>
							</li>
							<li>
								<router-link to="/contact" class="smooth">Liên hệ</router-link>
							</li>
						</ul>
					</nav>
					<div class="head-crt">
						<div class="head-search">
							<span class="ic-search">
								<i class="icon_search"></i>
							</span>
							<div class="form-search">
								<div class="form-group">
									<input type="text" placeholder="Tìm kiếm ..." />
									<button type="submit">
										<i class="icon_search"></i>
									</button>
								</div>
							</div>
						</div>
						<div class="head-lang">
							<img src="images/lang-vi.jpg" alt />
							<ul>
								<li class="active">
									<a href title>
										<img src="images/lang-vi.jpg" alt />Tiếng Việt
									</a>
								</li>
								<li>
									<a href title>
										<img src="images/lang-japan.jpg" alt />Tiếng Nhật
									</a>
								</li>
							</ul>
						</div>
						<a href="javascript:;" title class="head-login" data-toggle="modal" data-target="#pu-login">
							<i class="lnr lnr-user"></i>
							<span>Đăng nhập</span>
						</a>
					</div>
				</div>
				<div class="icon-menu open-mnav">
					<span></span>
					<span></span>
					<span></span>
				</div>
			</div>
		</div>
	</header>
</template>
<script>
import { mapActions } from 'vuex';

export default {
	data() {
		return {
			items: []
		}
	},
	computed: {
		
	},
	created() {
	},
	methods: {
		...mapActions('category', ['getList'])
	},
};
</script>
<style>
</style>