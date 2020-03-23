<template>
	<section class="page-primary v2">
		<div class="container">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item">
						<a href="#">Trang chủ</a>
					</li>
					<li class="breadcrumb-item">
						<a href="#">Tài khoản</a>
					</li>
					<li class="breadcrumb-item active" aria-current="page">Thông tin tài khoản</li>
				</ol>
			</nav>
			<div class="wrap-account">
				<div class="row">
					<div class="col-lg-3">
						<div class="sb-account">
							<h3 class="title">
								<img src="images/ic-user.jpg" alt />Tài khoản của tôi
							</h3>
							<ul>
								<li>
									<a href="account-profile.html" title>
										<i class="lnr lnr-user"></i>Thông tin cá nhân
									</a>
								</li>
								<li class="active">
									<a href="history-order.html" title>
										<i class="lnr lnr-history"></i>Lịch sử mua hàng
									</a>
								</li>
								<li>
									<a href="#" title>
										<i class="lnr lnr-exit"></i>Đăng xuất
									</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="col-lg-9">
						<div class="ct-account">
							<h3 class="title-acc v2">Lịch sử mua hàng</h3>
							<div class="history-order">
								<table class="table">
									<tr>
										<th>Mã đơn hàng</th>
										<th>Ngày mua</th>
										<th>Sản phẩm</th>
										<th>Tổng tiền</th>
										<th>Trạng thái</th>
									</tr>
									<tr>
										<td>
											<a href="history-order-detail.html" title>TM123463</a>
										</td>
										<td>16/06/2018</td>
										<td>Bắp cải, Bí đao, Ba chỉ... và 3 sản phẩm khác</td>
										<td>550.000đ</td>
										<td>Đang thanh toán</td>
									</tr>
									<tr>
										<td>
											<a href="history-order-detail.html" title>TM123463</a>
										</td>
										<td>16/06/2018</td>
										<td>Bắp cải, Bí đao, Ba chỉ... và 3 sản phẩm khác</td>
										<td>550.000đ</td>
										<td>Giao thành công</td>
									</tr>
									<tr>
										<td>
											<a href="history-order-detail.html" title>TM123463</a>
										</td>
										<td>16/06/2018</td>
										<td>Bắp cải, Bí đao, Ba chỉ... và 3 sản phẩm khác</td>
										<td>550.000đ</td>
										<td>Giao thành công</td>
									</tr>
									<tr>
										<td>
											<a href="history-order-detail.html" title>TM123463</a>
										</td>
										<td>16/06/2018</td>
										<td>Bắp cải, Bí đao, Ba chỉ... và 3 sản phẩm khác</td>
										<td>550.000đ</td>
										<td>Giao thành công</td>
									</tr>
									<tr>
										<td>
											<a href="history-order-detail.html" title>TM123463</a>
										</td>
										<td>16/06/2018</td>
										<td>Bắp cải, Bí đao, Ba chỉ... và 3 sản phẩm khác</td>
										<td>550.000đ</td>
										<td>Giao thành công</td>
									</tr>
									<tr>
										<td>
											<a href="history-order-detail.html" title>TM123463</a>
										</td>
										<td>16/06/2018</td>
										<td>Bắp cải, Bí đao, Ba chỉ... và 3 sản phẩm khác</td>
										<td>550.000đ</td>
										<td>Giao thành công</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</template>
<script>
export default {};
</script>
<style>
</style>