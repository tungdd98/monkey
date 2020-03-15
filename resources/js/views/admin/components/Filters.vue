<template>
  <div class="v-filter">
    <el-select v-model="filter" placeholder="-- Sắp xếp theo --" size="small" @change="handleFilterState()">
      <el-option
        v-for="item in optionsSort"
        :key="item.id"
        :label="item.title"
        :value="item.id"
      ></el-option>
    </el-select>
    <el-select v-model="count" placeholder="-- Số bản ghi --" size="small" style="width: 140px" @change="handleFilterPerPage()">
      <el-option
        v-for="item in optionsPaginate"
        :key="item.value"
        :label="item.title"
        :value="item.value"
      ></el-option>
    </el-select>
  </div>
</template>
<script>
import foo from '@/configs'
import { mapState } from 'vuex'
export default {
  data() {
    return {
      filter: '',
      count: '',
      optionsSort: foo.FILTER.order,
      optionsPaginate: foo.FILTER.per_page
    }
  },
  props: {
    controller: { type: String, default: '' }
  },
  computed: {
    ...mapState({
      per_page: state => state.slider.per_page,
      order_by: state => state.slider.order_by,
      order_dir: state => state.slider.order_dir
    })
  },
  methods: {
    /**
     * Lọc theo options
     */
    handleFilterState() {
      let { per_page } = this
      let idx = this.optionsSort.findIndex(option => option.id === this.filter)
      let order = this.optionsSort[idx].value
      this.$store.dispatch(`${this.controller}/getList`, {
        per_page,
        order_by: order.order_by,
        order_dir: order.order_dir
      })
    },
    /**
     * Lọc theo số bản ghi
     */
    handleFilterPerPage() {
      let { order_by, order_dir } = this
      this.$store.dispatch(`${this.controller}/getList`, {
        per_page: this.count,
        order_by,
        order_dir,
      })
    }
  }
}
</script>
<style>
</style>