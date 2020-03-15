<template>
  <div 
    class="v-status" 
    :title="item.status == 1 ? 'Hiển thị' : 'Ẩn'" 
    :class="_showStatus(item.status)" 
    @click="_changeStatus(controller, { ...item, field: 'status' })">
  </div>
</template>
<script>
export default {
  props: {
    item: { type: Object, default: null },
    controller: { type: String, default: '' }
  }
}
</script>
<style>
</style>