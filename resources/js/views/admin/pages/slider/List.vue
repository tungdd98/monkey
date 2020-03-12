<template>
  <div class="v-products">
    <el-row>
      <el-col :span="12">
        <filters 
          :per_page="per_page" 
          :order="order" 
          @handleInputPerPage="handleInputPerPage"
          @handleInputOrder="handleInputOrder"
        ></filters>
      </el-col>
      <el-col :span="12">
        <edit></edit>
      </el-col>
    </el-row>
    <div class="v-products-table">
      <el-table v-loading="isLoading" :data="items" v-if="items">
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
      <pagination :total="total" :controller="controller" :per_page="per_page"></pagination>
    </div>
  </div>
</template>
<script>
import Edit from './Edit'
import Filters from '../../components/Filters'
import Actions from '../../components/Actions'
import Pagination from '../../components/Pagination'
import { mapActions, mapState, mapGetters } from 'vuex'
import foo from '@/configs'

const controller = 'slider'

export default {
  data() {
    return {
      controller,
      foo,
      per_page: foo.PAGINATE.per_page,
      order: {}
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
    /**
     * Khởi tạo dữ liệu
     */
    init(){
      this.getList({})
    },
    /**
     * Phân trang
     */
    handleCurrChange(val) {
      this.getList({
        page: val
      })
    },
    /**
     * Lọc theo số bản ghi
     */
    handleInputPerPage(data) {
      this.per_page = data
      console.log(this.per_page)
      if(this.per_page === 'all') {
        this.getList({
          pagination: false
        })
      } else {
        this.getList({
          per_page: this.per_page
        })
      }
    },
    /**
     * Lọc theo options còn lại
     */
    handleInputOrder(data) {
      this.getList({
        order_by: data.order_by,
        order_dir: data.order_dir,
        per_page: this.per_page
      })
    }
  },
  components: {
    Edit,
    Actions,
    Filters,
    Pagination
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