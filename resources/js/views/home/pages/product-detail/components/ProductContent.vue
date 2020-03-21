<template>
	<div class="info-pro-dt" v-if="data">
		<h1 class="title-pro">{{ _notag(data.title) }}</h1>
		<div class="price">
			<strong>{{ data.sale_up > 0 ? _formatCurrency(priceSale) : _formatCurrency(data.price) }}</strong>
			<del>{{ _formatCurrency(data.price) }}</del>
		</div>
		<div
			class="desc"
			v-html="data.description"
		>{{ data.description }}</div>
		<ul class="pro-properties clearfix">
			<li>
				<strong>Mã sản phẩm: </strong>{{ data.code ? _notag(data.code) : '' }}
			</li>
			<li>
				<strong>Đơn vị tính: </strong>{{ _notag(info.unit) }}
			</li>
			<li>
				<strong>Nhà sản xuất: </strong>{{ _notag(info.supplier) }}
			</li>
			<li>
				<strong>Trạng thái: </strong>{{ data.quantity > 0 ? 'Còn hàng' : 'Hết hàng' }}
			</li>
		</ul>
		<div class="pro-quantity">
			<span>Số lượng: {{ data.quantity }}</span>
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
</template>
<script>
import { mapActions } from 'vuex';
export default {
	data() {
		return {
			info: {
				unit: '',
				supplier: ''
			}
		}
	},
	props: {
		data: { type: Object, default: {} },
		id: { type: [Number, String] }
	},
	computed: {
		priceSale() {
			return Math.floor(this.data.price - (this.data.sale_up)/100 * this.data.price)
		},
	},
	created() {
		['unit', 'supplier'].forEach(value => {
			this.getPropertyById({ id: this.id, property: value }).then(res => {
				if(res.flag && res.data.length > 0) {
					this.info[value] = res.data[0].title
				}
			})
		})
	},
	methods: {
		...mapActions('product', ['getPropertyById']),
	}
};
</script>
<style>
</style>