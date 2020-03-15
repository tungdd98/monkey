<template>
  <div 
    class="v-status" 
    :title="item.status == 1 ? 'Hiển thị' : 'Ẩn'" 
    :class="_showStatus(item.status)" 
    @click="handleChangeStatus">
  </div>
</template>
<script>
import { mapState } from 'vuex'
import foo from '@/configs'

export default {
  props: {
    item: { type: Object, default: null },
    controller: { type: String, default: '' },
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
     * Thay đổi trạng thái phần tử
     */
    handleChangeStatus() {
      let { per_page, order_by, order_dir } = this
      this.$store.dispatch(`${this.controller}/changeStatus`, { ...this.item, field: 'status' })
      .then(res => {
        if(res.flag) {
          this.$store.dispatch(`${this.controller}/getList`, {
            per_page,
            order_by,
            order_dir
          })
          this.$fire(foo.NOTIFICATION.success.updated)
        } else {
          this.$fire(foo.NOTIFICATION.error)
        }
      })
    }
  }
}
</script>
<style>
</style>