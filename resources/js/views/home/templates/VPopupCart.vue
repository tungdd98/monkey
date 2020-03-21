<template>
	<div>
		<a href title class="icon-cart" data-toggle="modal" data-target="#pu-cart">
			<i class="fa fa-shopping-cart"></i>
			<span>1</span>
		</a>
		<div class="modal popup-cart popup-primary fade" id="pu-cart">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<button type="button" class="close" data-dismiss="modal">
						<i class="icon_close"></i>
					</button>
					<!-- Modal body -->
					<div class="modal-body">
						<h3 class="title-cart">
							giỏ hàng của bạn
							<span>(3 sản phẩm)</span>
						</h3>
						<div class="md-cart-tb">
							<table>
								<thead>
									<tr>
										<th>Sản phẩm</th>
										<th>Giá</th>
										<th>Số lượng</th>
										<th>Thành tiền</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<div class="if-pro-cart">
												<a class="img" href="#" title>
													<img src="tomita/images/cart1.jpg" alt title />
												</a>
												<div class="ct">
													<a class="smooth title" href="#" title>Thịt chân giò hữu cơ</a>
													<a class="smooth remove" href="#" title>
														<i class="icon_close"></i> Bỏ sản phẩm
													</a>
												</div>
											</div>
										</td>
										<td>
											180.000đ
											<del>200.000đ</del>
										</td>
										<td>
											<div class="i-number">
												<button class="n-ctrl down smooth"></button>
												<input type="text" class="numberic" min="1" max="1000" value="1" />
												<button class="n-ctrl up smooth"></button>
											</div>
										</td>
										<td>180.000đ</td>
									</tr>
									<tr>
										<td>
											<div class="if-pro-cart">
												<a class="img" href="#" title>
													<img src="tomita/images/cart2.jpg" alt title />
												</a>
												<div class="ct">
													<a class="smooth title" href="#" title>Cá hồi Nauy tươi Fillet</a>
													<a class="smooth remove" href="#" title>
														<i class="icon_close"></i> Bỏ sản phẩm
													</a>
												</div>
											</div>
										</td>
										<td>679.000đ</td>
										<td>
											<div class="i-number">
												<button class="n-ctrl down smooth"></button>
												<input type="text" class="numberic" min="1" max="1000" value="1" />
												<button class="n-ctrl up smooth"></button>
											</div>
										</td>
										<td>679.000đ</td>
									</tr>
									<tr>
										<td>
											<div class="if-pro-cart">
												<a class="img" href="#" title>
													<img src="tomita/images/cart3.jpg" alt title />
												</a>
												<div class="ct">
													<a class="smooth title" href="#" title>Cải thảo Baby</a>
													<a class="smooth remove" href="#" title>
														<i class="icon_close"></i> Bỏ sản phẩm
													</a>
												</div>
											</div>
										</td>
										<td>39.000đ</td>
										<td>
											<div class="i-number">
												<button class="n-ctrl down smooth"></button>
												<input type="text" class="numberic" min="1" max="1000" value="1" />
												<button class="n-ctrl up smooth"></button>
											</div>
										</td>
										<td>39.000đ</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="md-cart-foot">
							<div class="top">
								<span class="total-provision">Tổng tạm tính: 898.000đ</span>
								<span class="line">|</span>
								<span class="transport">Phí vận chuyển: 25.000đ</span>
								<span class="line">|</span>
								<div class="total">
									<p>
										Tổng cộng:
										<strong>923.000đ</strong>
									</p>
									<span>(Giá đã bao gồm thuế VAT)</span>
								</div>
							</div>
							<div class="bottom">
								<div class="cell">
									<a class="smooth ctrl-continue" href="#" title>
										<i class="arrow_left"></i> Tiếp tục mua hàng
									</a>
								</div>
								<div class="cell">
									<a class="smooth ctrl-payment" href="#" title>Gửi đơn hàng</a>
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
export default {};
</script>
<style>
</style>