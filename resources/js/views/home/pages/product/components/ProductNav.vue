<template>
	<div class="sb-product">
		<div class="block-cate-pro">
			<h3 class="title">Danh mục sản phẩm</h3>
			<div id="accordion">
				<div class="card">
					<div class="card-header">
						<a class="card-link" data-toggle="collapse" href="#collap1">Rau, củ, quả</a>
					</div>
					<div id="collap1" class="collapse show" data-parent="#accordion">
						<div class="card-body">
							<ul>
								<li>
									<a href title>Rau Ăn Lá</a>
								</li>
								<li>
									<a href title>Rau Ăn Củ</a>
								</li>
								<li>
									<a href title>Rau Ăn Quả</a>
								</li>
								<li>
									<a href title>Rau Gia Vị</a>
								</li>
								<li>
									<a href title>Nấm - Rau Mầm</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-header">
						<a class="collapsed card-link" data-toggle="collapse" href="#collap2">Thịt heo, bò, gà</a>
					</div>
					<div id="collap2" class="collapse" data-parent="#accordion">
						<div class="card-body">
							<ul>
								<li>
									<a href title>Thịt heo</a>
								</li>
								<li>
									<a href title>Thịt bò</a>
								</li>
								<li>
									<a href title>Thịt gà</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-header">
						<a class="collapsed card-link" data-toggle="collapse" href="#collap3">Thủy, hải sản</a>
					</div>
					<div id="collap3" class="collapse" data-parent="#accordion">
						<div class="card-body">
							<ul>
								<li>
									<a href title>Cua</a>
								</li>
								<li>
									<a href title>Ghẹ</a>
								</li>
								<li>
									<a href title>Tôm</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="block-qc v2">
			<a href title>
				<img src="tomita/images/bn-qc1.jpg" alt />
			</a>
		</div>
		<div class="block-qc v2">
			<a href title>
				<img src="tomita/images/bn-qc2.jpg" alt />
			</a>
		</div>
	</div>
</template>
<script>
import { mapGetters } from 'vuex';
export default {
	computed: {
    ...mapGetters({
      categories: 'category/getAll'
    }),
  },
};
</script>
<style>
</style>