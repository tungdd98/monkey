<template>
  <el-pagination
    v-if="total > 0"
    background
    class="v-pagination"
    layout="prev, pager, next"
    @current-change="handleCurrChange"
    :total="total"
    :page-size="per_page"
  ></el-pagination>
</template>
<script>
import foo from '@/configs'

export default {
  data() {
    return {
      foo
    }
  },
  props: {
    controller: { type: String, default: '' },
    total: { type: Number, default: 0 },
    per_page: { type: Number, default: 0 }
  },
  methods: {
    handleCurrChange(val) {
      this.$store.dispatch(`${this.controller}/getList`, {
        page: val
      })
    }
  }
}
</script>
<style>
</style>