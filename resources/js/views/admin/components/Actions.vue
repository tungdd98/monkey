<template>
  <el-table-column fixed="right" label="Thao tác" align="center" width="120">
    <template>
      <!-- <el-button type="primary" icon="el-icon-edit" circle size="small"></el-button> -->
      <el-button 
        v-for="item in foo.ACTION[controller]"
        :key="item.title" 
        :type="item.type" 
        :icon="item.icon" 
        :size="item.size"
        :title="item.title"
        circle 
      ></el-button>
    </template>
  </el-table-column>
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
    controller: { type: String, default: '' }
  }
}
</script>
<style>
</style>