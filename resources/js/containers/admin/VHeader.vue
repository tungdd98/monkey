<template>
  <el-header class="v-header" height="106px">
    <v-header-top />
    <v-breadcrumb />
  </el-header>
</template>
<script>
import VBreadcrumb from './VBreadcrumb'
import VHeaderTop from './VHeaderTop'
export default {
  name: "v-header",
  components: {
    VBreadcrumb,
    VHeaderTop
  }
};
</script>
<style lang="">
</style>