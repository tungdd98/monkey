<template>
	<div class="list-product">
		<div class="head">
			<h3 class="title-pro">Tất cả</h3>
			<product-filter></product-filter>
		</div>
		<div class="row">
			<product-item
        v-for="item in items"
        :key="item.id"
        :item="item"
        :controller="controller"
      ></product-item>
		</div>
    <product-pagination></product-pagination>
	</div>
</template>
<script>
import ProductItem from './ProductItem'
import ProductPagination from './ProductPagination'
import ProductFilter from './ProductFilter'
import { mapActions, mapGetters } from 'vuex';

const CONTROLLER = 'product'

export default {
  data() {
    return {
      controller: CONTROLLER,
    }
  },
  computed: {
    ...mapGetters({
      items: `${CONTROLLER}/getAll`,
      total: `${CONTROLLER}/getTotalList`
    })
  },
  watch: {
    '$route' (to, from ) {
      this.init()
    }
  },
  created() {
    this.init()
  },
  methods: {
    ...mapActions(CONTROLLER, ['getListTomita']),
    init() {
      let tag = parseInt(this.$route.query.tag)
      this.getListTomita({ tag })
    }
  },
  components: {
    ProductItem,
    ProductPagination,
    ProductFilter
  },
};
</script>
<style>
</style>