<template>
  <el-pagination
    background
    class="v-pagination"
    layout="prev, pager, next"
    @current-change="handleCurrChange"
    :total="total"
    :page-size="paginate.per_page"
  ></el-pagination>
</template>
<script>
export default {
}
</script>
<style>
</style>