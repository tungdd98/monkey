<template>
	<div class="product-intro" v-if="data">
		<h3 class="title">Thông tin sản phẩm</h3>
		<div class="s-content" v-html="data.content">
			{{ data.content }}
		</div>
	</div>
</template>
<script>
export default {
	props: {
		data: { type: Object, default: '' }
	}
};
</script>
<style>
</style>