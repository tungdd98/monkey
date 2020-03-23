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
								<li class="active">
									<a href="account-profile.html" title>
										<i class="lnr lnr-user"></i>Thông tin cá nhân
									</a>
								</li>
								<li>
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
							<h3 class="title-acc">thông tin cá nhân</h3>
							<div class="form-account">
								<div class="form-group">
									<span>
										Email
										<small>*</small> :
									</span>
									<input type="email" class="form-control" value="duyhieuit@gmail.com" disabled />
								</div>
								<div class="form-group">
									<span>
										Họ tên
										<small>*</small> :
									</span>
									<input type="text" class="form-control" value="Nguyễn Duy Hiếu" />
								</div>
								<div class="form-group">
									<span>
										Số điện thoại
										<small>*</small> :
									</span>
									<input type="tel" class="form-control" value="0912310691" />
								</div>
								<div class="form-group">
									<span>Ngày sinh</span>
									<div class="row col-mar-5 right">
										<div class="col-4">
											<div class="ip-select">
												<select class="form-control">
													<option value>Ngày</option>
													<option value>1</option>
													<option value>2</option>
													<option value>3</option>
												</select>
											</div>
										</div>
										<div class="col-4">
											<div class="ip-select">
												<select class="form-control">
													<option value>Tháng</option>
													<option value>1</option>
													<option value>2</option>
													<option value>3</option>
												</select>
											</div>
										</div>
										<div class="col-4">
											<div class="ip-select">
												<select class="form-control">
													<option value>Năm</option>
													<option value>1</option>
													<option value>2</option>
													<option value>3</option>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group">
									<span>Giới tính :</span>
									<div class="ip-select right">
										<select class="form-control">
											<option value>Nam</option>
											<option value>Nữ</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<span>Nghề nghiệp :</span>
									<input type="text" class="form-control" placeholder="Chưa xác định" />
								</div>
								<div class="form-group">
									<span>Địa chỉ :</span>
									<div class="list-address">
										<div class="block-address">
											<div class="top">
												<div class="left">
													<span class="name">Nguyễn Duy Hiếu</span>
													<span class="note">
														<i class="icon_check_alt2"></i>Địa chỉ mặc định
													</span>
												</div>
												<div class="crt">
													<a href="account-profile-detail.html" title class="edit">Chỉnh sửa</a>
												</div>
											</div>
											<div
												class="address"
											>Địa chỉ: Số nhà 15 , ngõ 259/9 Phố Vọng , Hà Nội, Phường Đồng Tâm, Quận Hai Bà Trưng, Hà Nội, Việt Nam</div>
										</div>

										<div class="block-address">
											<div class="top">
												<div class="left">
													<span class="name">NGUYỄN thị ngọc hoa</span>
													<!-- <span class="note"><i class="icon_check_alt2"></i>Địa chỉ mặc định</span> -->
												</div>
												<div class="crt">
													<a href="account-profile-detail.html" title class="edit">Chỉnh sửa</a>
													<a href title class="delete">Xóa</a>
												</div>
											</div>
											<div
												class="address"
											>Địa chỉ: Số nhà 15 , ngõ 259/9 Phố Vọng , Hà Nội, Phường Đồng Tâm, Quận Hai Bà Trưng, Hà Nội, Việt Nam</div>
										</div>
										<a href="account-profile-detail.html" title class="btn-address">
											<i class="icon_plus"></i>Thêm địa chỉ mới
										</a>
									</div>
								</div>
								<div class="form-group">
									<span class="empty">&nbsp;</span>
									<button class="btn-account" type="submit">Cập nhật</button>
								</div>
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