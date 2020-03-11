<template>
  <div class="v-products">
    <edit></edit>
    <div class="v-products-table">
      <el-table v-loading="isLoading" v-if="items" :data="items">
        <el-table-column type="index" width="50" align="center"></el-table-column>
        <el-table-column type="selection" width="55"></el-table-column>
        <el-table-column width="50">
          <template slot-scope="scope">
            <div class="v-status" :class="showStatus(scope.row.status)"></div>
          </template>
        </el-table-column>
        <el-table-column label="Ảnh" align="center" width="120">
          <template slot-scope="scope">
            <el-image
              style="width: 80px; height: 80px"
              fit="cover"
              :src="getThumbnail(controller, scope.row.thumbnail)"
            ></el-image>
          </template>
        </el-table-column>
        <el-table-column label="Tiêu đề">
          <template slot-scope="scope">
            <div class="v-h2">{{ scope.row.title }}</div>
            <div class="v-italic">Mô tả: {{ scope.row.description }}</div>
          </template>
        </el-table-column>
        <el-table-column label="Link">
          <template slot-scope="scope">
            <div>{{ scope.row.link }}</div>
          </template>
        </el-table-column>
        <el-table-column label="Ngày tạo">
          <template slot-scope="scope">
            <div>{{ dateFormat(scope.row.created_at, 'short') }}</div>
            <div class="v-italic">{{ scope.row.created_by }}</div>
          </template>
        </el-table-column>
        <el-table-column label="Cập nhật lần cuối">
          <template slot-scope="scope">
            <div>{{ dateFormat(scope.row.updated_at, 'short') }}</div>
            <div class="v-italic">{{ scope.row.updated_by }}</div>
          </template>
        </el-table-column>
        <actions></actions>
      </el-table>
      <el-pagination
        background
        class="v-pagination"
        layout="prev, pager, next"
        @current-change="handleCurrChange"
        :total="total"
        :page-size="paginate.per_page"
      ></el-pagination>
    </div>
  </div>
</template>
<script>
import Edit from './Edit'
import Actions from '../../components/Actions'
import { mapActions, mapState, mapGetters } from 'vuex'
import { paginate } from '@/configs'
const controller = 'slider'

export default {
  data() {
    return {
      controller,
      paginate
    }
  },
  computed: {
    ...mapState({
      isLoading: state => state.isLoading
    }),
    ...mapGetters({
      items: `${controller}/getAll`,
      total: `${controller}/getTotalList`
    })
  },
  created() {
    this.init()
  },
  methods: {
    ...mapActions(controller, ['getList']),
    init(){
      this.getList({}, true)
    },
    handleCurrChange(val) {
      this.getList({
        page: val
      })
    },
  },
  components: {
    Edit,
    Actions
  }
}
</script>
<style lang="scss">
.el-table th>.cell {
  font-weight: 600;
}
.v-italic {
  font-style: italic;
}
.v-h2 {
  font-weight: 600;
}
</style>