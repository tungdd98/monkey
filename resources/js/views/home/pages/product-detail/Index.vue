<template>
	<section class="page-product-dt page-primary v2">
		<div class="container">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item">
						<a href="#">Trang chủ</a>
					</li>
					<li class="breadcrumb-item">
						<a href="#">Sản phẩm</a>
					</li>
					<li class="breadcrumb-item">
						<a href="#">Thực phẩm tưới sống</a>
					</li>
					<li class="breadcrumb-item active" aria-current="page">Cá hồi Nauy tươi Fillet</li>
				</ol>
			</nav>
			<div class="details-product">
				<div class="row">
					<div class="col-lg-6">
						<div class="sl-img-pro">
							<span class="sales v2">-10%</span>
							<slick :options="topSlick.options" class="pro-img" :ref="topSlick.name">
								<div class="item">
									<a class="c-img" href="tomita/images/b-pro.jpg" title data-fancybox="gallery">
										<img src="tomita/images/b-pro.jpg" alt />
									</a>
								</div>
								<div class="item">
									<a class="c-img" href="tomita/images/b-pro.jpg" title data-fancybox="gallery">
										<img src="tomita/images/b-pro.jpg" alt />
									</a>
								</div>
								<div class="item">
									<a class="c-img" href="tomita/images/b-pro.jpg" title data-fancybox="gallery">
										<img src="tomita/images/b-pro.jpg" alt />
									</a>
								</div>
								<div class="item">
									<a class="c-img" href="tomita/images/b-pro.jpg" title data-fancybox="gallery">
										<img src="tomita/images/b-pro.jpg" alt />
									</a>
								</div>
								<div class="item">
									<a class="c-img" href="tomita/images/b-pro.jpg" title data-fancybox="gallery">
										<img src="tomita/images/b-pro.jpg" alt />
									</a>
								</div>
								<div class="item">
									<a class="c-img" href="tomita/images/b-pro.jpg" title data-fancybox="gallery">
										<img src="tomita/images/b-pro.jpg" alt />
									</a>
								</div>
								<div class="item">
									<a class="c-img" href="tomita/images/b-pro.jpg" title data-fancybox="gallery">
										<img src="tomita/images/b-pro.jpg" alt />
									</a>
								</div>
								<div class="item">
									<a class="c-img" href="tomita/images/b-pro.jpg" title data-fancybox="gallery">
										<img src="tomita/images/b-pro.jpg" alt />
									</a>
								</div>
							</slick>
							<slick :options="bottomSlick.options" class="pro-thumb" :ref="bottomSlick.name">
								<div class="item">
									<a class="c-img">
										<img src="tomita/images/m-pro.jpg" alt />
									</a>
								</div>
								<div class="item">
									<a class="c-img">
										<img src="tomita/images/m-pro1.jpg" alt />
									</a>
								</div>
								<div class="item">
									<a class="c-img">
										<img src="tomita/images/m-pro2.jpg" alt />
									</a>
								</div>
								<div class="item">
									<a class="c-img">
										<img src="tomita/images/m-pro3.jpg" alt />
									</a>
								</div>
								<div class="item">
									<a class="c-img">
										<img src="tomita/images/m-pro.jpg" alt />
									</a>
								</div>
								<div class="item">
									<a class="c-img">
										<img src="tomita/images/m-pro1.jpg" alt />
									</a>
								</div>
								<div class="item">
									<a class="c-img">
										<img src="tomita/images/m-pro2.jpg" alt />
									</a>
								</div>
								<div class="item">
									<a class="c-img">
										<img src="tomita/images/m-pro3.jpg" alt />
									</a>
								</div>
							</slick>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="info-pro-dt">
							<h1 class="title-pro">CÁ HỒI NA UY TƯƠI FILLET</h1>
							<div class="price">
								<strong>679.000đ</strong>
								<del>700.000đ</del>
							</div>
							<div
								class="desc"
							>Cá hồi là loại cá sống trong môi trường nước động, có nhiệt độ thấp. Cá hồi tự nhiên có đặc trưng là bơi ngược sông để đẻ. Chúng sinh ra tại khu vực nước ngọt, di cư ra biển, sau đó quay trở lại vùng nước ngọt để sinh sản. Tuy nhiên, có nhiều con thuộc nhiều loài sống cả đời tại vùng nước nhiều loài sống cả đời tại vùng nước</div>
							<ul class="pro-properties clearfix">
								<li>
									<strong>Mã sản phẩm :</strong>TMCH79
								</li>
								<li>
									<strong>Đơn vị tính :</strong>Kilogram
								</li>
								<li>
									<strong>Xuất xứ :</strong>Nhập khẩu Nauy
								</li>
								<li>
									<strong>Trạng thái :</strong>Còn hàng
								</li>
							</ul>
							<div class="pro-quantity">
								<span>Số lượng :</span>
								<div class="i-number">
									<button class="n-ctrl down smooth"></button>
									<input type="text" class="numberic" min="1" max="1000" value="1" />
									<button class="n-ctrl up smooth"></button>
								</div>
							</div>
							<div class="btn-addcart">
								<a href title>Thêm vào giỏ hàng</a>
							</div>
							<div class="pro-socials">
								<span>Chia sẻ :</span>
								<ul>
									<li>
										<a href title>
											<i class="social_facebook"></i>
										</a>
									</li>
									<li>
										<a href title>
											<i class="social_twitter"></i>
										</a>
									</li>
									<li>
										<a href title>
											<i class="social_googleplus"></i>
										</a>
									</li>
									<li>
										<a href title>
											<i class="social_youtube"></i>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="product-intro">
					<h3 class="title">Thông tin sản phẩm</h3>
					<div class="s-content">
						<p>Cá hồi là loại cá sống trong môi trường nước động, có nhiệt độ thấp. Cá hồi tự nhiên có đặc trưng là bơi ngược sông để đẻ. Chúng sinh ra tại khu vực nước ngọt, di cư ra biển, sau đó quay trở lại vùng nước ngọt để sinh sản. Tuy nhiên, có nhiều con thuộc nhiều loài sống cả đời tại vùng nước ngọt. Theo những chuyên gia ẩm thực nổi tiếng đánh giá thì cá hồi Na Uy cho chất lượng tốt nhất. Cá hồi Na Uy là loại thực phẩm rất giàu dinh dưỡng, đặc biệt là rất giàu Omega 3 giúp duy trì sức khỏe não bộ, chống các dấu hiệu lão hóa, cải thiện sức khỏe của mắt, hạn chế cao huyết áp, ngăn ngừa bệnh về tim mạch,… . Viện tim mạch của Hoa Kì khuyến khích nên ăn các loài cá nhất là các loại cá chứa nhiều axit béo giàu Omega-3 như cá hồi Na Uy ít nhất 2 lần một tuần để giúp cơ thể khỏe mạnh hơn.</p>
						<p>Cá hồi Na Uy được cho là có thân hình lớn nhất so với các giống khác Một con cá hồi thông thường dài khoảng 1m, tối đa có thể dài tới 150cm. Tuổi thọ của chúng có thể lên tới 13 năm, với chuỗi thức ăn khá đa dạng để chúng có thể sống sót trong làn nước lạnh ngắt tại Na Uy. Trọng lượng trung bình của cá hồi Na Uy khoảng 6-8kg/con. Nguồn thức ăn của cá hồi bao gồm các động vật giáp xác khi chúng còn nhỏ và ăn các loại cá bé hơn khi chúng lớn.</p>
						<p>Các món ăn ngon được chế biến từ cá hồi có thể kể đến như: sushi cá hồi, cá hồi sốt chanh leo, cá hồi nướng giấy bạc, cá hồi áp chảo, canh chua cá hồi...</p>
					</div>
				</div>
			</div>
			<div class="product-related">
				<h3 class="head">Sản phẩm liên quan</h3>
				<carousel class="sl-pro-related" :dots="false" :margin="30" :loop="false" :responsive="related.responsive" :navText="related.navText">
					<div class="item-product">
						<a href title class="img-primary">
							<img src="tomita/images/product1.jpg" alt />
						</a>
						<div class="ct">
							<h3 class="title">
								<a href="product-details.html" title>Thịt Chân Giò hữu cơ</a>
							</h3>
							<p class="note">Xuất xứ: Văn Giang, Hưng Yên</p>
							<div class="price">
								<span>
									<strong>180.000</strong>/Kg
								</span>
								<del>200.000đ/Kg</del>
							</div>
						</div>
						<span class="sales">-10%</span>
						<div href class="control">
							<a href title class="add-cart btn-crt">
								<i class="fa fa-cart-plus"></i>
							</a>
							<a href="product-details.html" title class="view-details btn-crt">
								<i class="fa fa-external-link"></i>
							</a>
							<a href="product-details.html" class="link"></a>
						</div>
					</div>
					<div class="item-product">
						<a href title class="img-primary">
							<img src="tomita/images/product2.jpg" alt />
						</a>
						<div class="ct">
							<h3 class="title">
								<a href="product-details.html" title>Thịt Chân Giò hữu cơ</a>
							</h3>
							<p class="note">Xuất xứ: Văn Giang, Hưng Yên</p>
							<div class="price">
								<span>
									<strong>180.000</strong>/Kg
								</span>
								<del>200.000đ/Kg</del>
							</div>
						</div>
						<span class="sales">-10%</span>
						<div href class="control">
							<a href title class="add-cart btn-crt">
								<i class="fa fa-cart-plus"></i>
							</a>
							<a href="product-details.html" title class="view-details btn-crt">
								<i class="fa fa-external-link"></i>
							</a>
							<a href="product-details.html" class="link"></a>
						</div>
					</div>
					<div class="item-product">
						<a href title class="img-primary">
							<img src="tomita/images/product3.jpg" alt />
						</a>
						<div class="ct">
							<h3 class="title">
								<a href="product-details.html" title>Thịt Chân Giò hữu cơ</a>
							</h3>
							<p class="note">Xuất xứ: Văn Giang, Hưng Yên</p>
							<div class="price">
								<span>
									<strong>180.000</strong>/Kg
								</span>
								<del>200.000đ/Kg</del>
							</div>
						</div>
						<span class="sales">-10%</span>
						<div href class="control">
							<a href title class="add-cart btn-crt">
								<i class="fa fa-cart-plus"></i>
							</a>
							<a href="product-details.html" title class="view-details btn-crt">
								<i class="fa fa-external-link"></i>
							</a>
							<a href="product-details.html" class="link"></a>
						</div>
					</div>
					<div class="item-product">
						<a href title class="img-primary">
							<img src="tomita/images/product1.jpg" alt />
						</a>
						<div class="ct">
							<h3 class="title">
								<a href="product-details.html" title>Thịt Chân Giò hữu cơ</a>
							</h3>
							<p class="note">Xuất xứ: Văn Giang, Hưng Yên</p>
							<div class="price">
								<span>
									<strong>180.000</strong>/Kg
								</span>
								<del>200.000đ/Kg</del>
							</div>
						</div>
						<span class="sales">-10%</span>
						<div href class="control">
							<a href title class="add-cart btn-crt">
								<i class="fa fa-cart-plus"></i>
							</a>
							<a href="product-details.html" title class="view-details btn-crt">
								<i class="fa fa-external-link"></i>
							</a>
							<a href="product-details.html" class="link"></a>
						</div>
					</div>
					<div class="item-product">
						<a href title class="img-primary">
							<img src="tomita/images/product2.jpg" alt />
						</a>
						<div class="ct">
							<h3 class="title">
								<a href="product-details.html" title>Thịt Chân Giò hữu cơ</a>
							</h3>
							<p class="note">Xuất xứ: Văn Giang, Hưng Yên</p>
							<div class="price">
								<span>
									<strong>180.000</strong>/Kg
								</span>
								<del>200.000đ/Kg</del>
							</div>
						</div>
						<span class="sales">-10%</span>
						<div href class="control">
							<a href title class="add-cart btn-crt">
								<i class="fa fa-cart-plus"></i>
							</a>
							<a href="product-details.html" title class="view-details btn-crt">
								<i class="fa fa-external-link"></i>
							</a>
							<a href="product-details.html" class="link"></a>
						</div>
					</div>
					<div class="item-product">
						<a href title class="img-primary">
							<img src="tomita/images/product3.jpg" alt />
						</a>
						<div class="ct">
							<h3 class="title">
								<a href="product-details.html" title>Thịt Chân Giò hữu cơ</a>
							</h3>
							<p class="note">Xuất xứ: Văn Giang, Hưng Yên</p>
							<div class="price">
								<span>
									<strong>180.000</strong>/Kg
								</span>
								<del>200.000đ/Kg</del>
							</div>
						</div>
						<span class="sales">-10%</span>
						<div href class="control">
							<a href title class="add-cart btn-crt">
								<i class="fa fa-cart-plus"></i>
							</a>
							<a href="product-details.html" title class="view-details btn-crt">
								<i class="fa fa-external-link"></i>
							</a>
							<a href="product-details.html" class="link"></a>
						</div>
					</div>
				</carousel>
			</div>
		</div>
	</section>
</template>
<script>
import Slick from "vue-slick";
import carousel from "vue-owl-carousel";
export default {
	data() {
		return {
			topSlick: {
				name: "top",
				options: {
					arrows: false,
					swipeToSlide: true,
					asNavFor: ".pro-thumb"
				}
			},
			bottomSlick: {
				name: "bottom",
				options: {
					slidesToShow: 7,
					slidesToScroll: 1,
					nextArrow: '<i class="fa fa-angle-right smooth next"></i>',
					prevArrow: '<i class="fa fa-angle-left smooth prev"></i>',
					autoplay: false,
					swipeToSlide: true,
					autoplaySpeed: 5000,
					asNavFor: ".pro-img",
					focusOnSelect: true,
					responsive: [
						{
							breakpoint: 1199,
							settings: {
								slidesToShow: 6
							}
						},
						{
							breakpoint: 991,
							settings: {
								slidesToShow: 8
							}
						},
						{
							breakpoint: 580,
							settings: {
								centerMode: false,
								slidesToShow: 6
							}
						},
						{
							breakpoint: 376,
							settings: {
								centerMode: false,
								slidesToShow: 5
							}
						}
					]
				}
			},
			related: {
				responsive: {
					1199: {
						items: 4
					},
					991: {
						items: 3
					},
					479: {
						items: 2
					},
					0: {
						items: 1
					}
				},
				navText: ["<i class='arrow_left_alt sl-arrow prev'></i>", "<i class='arrow_right_alt sl-arrow next'></i>"],
			}
		};
	},
	methods: {
		next() {
			this.$refs.top.next();
			this.$refs.bottom.next();
		},
		prev() {
			this.$refs.top.prev();
			this.$refs.bottom.prev();
		}
	},
	components: { Slick, carousel }
};
</script>
<style>
.sl-arrow {
	bottom: calc(100% + 5px) !important;
}
</style>