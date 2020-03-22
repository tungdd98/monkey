<template>
	<div class="col-lg-4 col-sm-6">
		<div class="item-product" v-if="item">
			<a href title class="img-primary">
				<img :src="_getThumbnail(controller, item.thumbnail)" alt />
			</a>
			<div class="ct">
				<h3 class="title">
					<router-link :title="_slug(item.title)" :to="getLinkItem(item)">{{ _notag(item.title) }}</router-link>
				</h3>
				<p class="note">Nhà cung cấp: {{ info.supplier }}</p>
				<div class="price">
					<span>
						<strong>{{ item.sale_up > 0 ? _formatCurrency(priceSale) : _formatCurrency(item.price) }}</strong>/{{ info.unit }}
					</span>
					<del v-show="item.sale_up > 0">{{ _formatCurrency(item.price) }}/{{ info.unit }}</del>
				</div>
			</div>
			<span class="sales" v-show="item.sale_up > 0">-{{ item.sale_up }}%</span>
			<div href class="control">
				<a href title class="add-cart btn-crt" @click.prevent="handleAddCart(item)">
					<i class="fa fa-cart-plus"></i>
				</a>
				<router-link :title="_slug(item.title)" :to="getLinkItem(item)" class="view-details btn-crt">
					<i class="fa fa-external-link"></i>
				</router-link>
				<router-link :to="getLinkItem(item)" class="link"></router-link>
			</div>
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
	computed: {
		priceSale() {
			return Math.floor(this.item.price - (this.item.sale_up)/100 * this.item.price)
		},
	},
	props: {
		item: { type: Object, default: {} },
		controller: { type: String, default: '' }
	},
	created() {
		['unit', 'supplier'].forEach(value => {
			this.getPropertyById({ id: this.item.id, property: value }).then(res => {
				if(res.flag && res.data.length > 0) {
					this.info[value] = res.data[0].title
				}
			})
		})
	},
	methods: {
		...mapActions('product', ['getPropertyById']),
		getLinkItem(item) {
			return {
				name: 'product-detail',
				params: {
					id: item.id
				}
			}
		},
		handleAddCart(item) {
			this.$store.dispatch('cart/changeProductToCart', {
				product: item,
				quantity: 1
			})
		}
	}
};
</script>
<style>
</style>