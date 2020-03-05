<template>
  <el-container class="full-height">
    <v-aside></v-aside>
    <el-container class="v-body">
      <v-header></v-header>
      <el-main>
        <router-view></router-view>
      </el-main>
      <v-footer></v-footer>
    </el-container>
  </el-container>
</template>
<script>
import VAside from '@/containers/admin/VAside'
import VHeader from '@/containers/admin/VHeader'
import VFooter from '@/containers/admin/VFooter'
export default {
  name: 'dashboard',
  components: {
    VAside,
    VHeader,
    VFooter
  }
}
</script>
<style>
</style>