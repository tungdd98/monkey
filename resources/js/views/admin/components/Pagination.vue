<template>
  <el-pagination
    v-if="total > 0 && per_page !== 0"
    background
    class="v-pagination"
    layout="prev, pager, next"
    @current-change="handleCurrChange"
    :total="total"
    :page-size="per_page"
  ></el-pagination>
</template>
<script>
import { mapState, mapGetters } from 'vuex'

export default {
  props: {
    controller: { type: String, default: '' },
    total: { type: Number, default: 0 },
  },
  computed: {
    ...mapState({
      per_page: state => state.slider.per_page,
      order_by: state => state.slider.order_by,
      order_dir: state => state.slider.order_dir
    }),
  },
  methods: {
    /**
     * Phân trang
     */
    handleCurrChange(val) {
      let { order_by, order_dir, per_page } = this
      this.$store.dispatch(`${this.controller}/getList`, {
        page: val,
        order_by,
        order_dir
      })
    }
  }
}
</script>
<style>
</style>