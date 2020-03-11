<template>
  <div class="v-products-table">
    <el-table v-loading="isLoading">

    </el-table>
  </div>
</template>
<script>
import Edit from './Edit'
import { mapActions, mapState } from 'vuex'
export default {
  data() {
    return {

    }
  },
  computed: {
    ...mapState({
      isLoading: state => state.isLoading
    })
  },
  created() {
    this.getList()
  },
  methods: {
    ...mapActions('slider', ['getList'])
  },
  components: {
    Edit
  }
}
</script>
<style>
</style>