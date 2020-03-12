<template>
  <div class="v-filter">
    <el-select v-model="filter" placeholder="-- Sắp xếp theo --" size="small" @change="handleInputOrder">
      <el-option
        v-for="item in optionsSort"
        :key="item.id"
        :label="item.title"
        :value="item.id"
      ></el-option>
    </el-select>
    <el-select v-model="count" placeholder="-- Số bản ghi --" size="small" style="width: 140px" @change="handleInputPerPage">
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
    per_page: { type: Number, default: 0 },
    order: { type: Object, default: null },
  },
  methods: {
    /**
     * Lọc theo số bản ghi
     */
    handleInputPerPage() {
      this.$emit('handleInputPerPage', this.count)
    },
    /**
     * Lọc theo những options còn lại
     */
    handleInputOrder() {
      let idx = this.optionsSort.findIndex(option => option.id === this.filter)
      this.$emit('handleInputOrder', this.optionsSort[idx].value)
    }
  }
}
</script>
<style>
</style>