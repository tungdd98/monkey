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
						<li v-for="item in menuLeft" :key="item.id">
							<router-link :to="item.url" class="smooth">{{ item.title }}</router-link>
							<ul v-if="item.children && item.children.length > 0">
								<li v-for="item in item.children" :key="item.id">
									<router-link to="/" class="smooth">{{ item.title }}</router-link>
								</li>
							</ul>
						</li>
					</ul>
				</nav>
				<a href="#" class="logo">
					<img src="tomita/images/logo.png" alt />
				</a>
				<div class="head-right">
					<nav class="d-nav">
						<ul>
							<li v-for="item in menuRight" :key="item.id">
								<router-link :to="item.url" class="smooth">{{ item.title }}</router-link>
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
							<img src="/tomita/images/lang-vi.jpg" alt />
							<ul>
								<li v-for="item in menuRight" :key="item.id">
									<router-link to="/" class="smooth">{{ item.title }}</router-link>
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
import { mapActions } from "vuex";
import foo from '@/configs'

export default {
	data() {
		return {
			items: [],
		};
	},
	computed: {
		menuLeft() {
			return this.items.filter((value, key) => key <= 3);
		},
		menuRight() {
			return this.items.filter((value, key) => key > 3);
		}
	},
	created() {
		this.getList({ action: "tree" }).then(res => {
			if (res.flag) {
				this.items = res.data;
				this.items.forEach((value, key) => {
					Object.entries(foo.URL).forEach(([idx, val]) => {
						if(value.type === idx) {
							value['url'] = val
						}
					})
				})
			}
		});
	},
	methods: {
		...mapActions("category", ["getList"])
	}
};
</script>
<style>
</style>