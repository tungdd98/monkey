<template>
	<section class="page-faqs page-primary">
		<div class="container">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item">
						<a href="#">Trang chủ</a>
					</li>
					<li class="breadcrumb-item">
						<a href="#">Hỗ trợ</a>
					</li>
					<li class="breadcrumb-item active" aria-current="page">Câu hỏi thường gặp?</li>
				</ol>
			</nav>
			<h2 class="head-primary v3">Câu hỏi thường gặp?</h2>
			<div id="accordion">
				<div class="card">
					<div class="card-header">
						<div v-b-toggle.collapse-1 class="collapsed card-link" style="cursor: pointer">
							Tôi có thể mua sản phẩm gì tại Tomita Mart?
						</div>
					</div>
					<b-collapse id="collapse-1">
						<div class="card-body">
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>

							<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
						</div>
					</b-collapse>
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