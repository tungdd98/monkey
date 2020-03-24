<template>
	<div class="sb-account">
		<h3 class="title">
			<img src="tomita/images/ic-user.jpg" alt />Tài khoản của tôi
		</h3>
		<ul>
			<li class="active">
				<router-link :to="{ name: 'profile' }">
					<i class="lnr lnr-user"></i>Thông tin cá nhân
				</router-link>
			</li>
			<li>
				<router-link :to="{ name: 'history-order' }">
					<i class="lnr lnr-history"></i>Lịch sử mua hàng
				</router-link>
			</li>
			<li>
				<a href="#" title>
					<i class="lnr lnr-exit"></i>Đăng xuất
				</a>
			</li>
		</ul>
	</div>
</template>
<script>
export default {};
</script>
<style>
</style>