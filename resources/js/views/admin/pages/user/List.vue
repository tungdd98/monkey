<template>
  <div class="v-products">
    <el-row>
      <el-col :span="12">
        <filters :controller="controller"></filters>
      </el-col>
      <el-col :span="12">
        <edit :controller="controller"></edit>
      </el-col>
    </el-row>
    <div class="v-products-table">
      <el-table v-loading="isLoading" :data="items" v-if="items">
        <el-table-column type="index" width="50" align="center"></el-table-column>
        <el-table-column type="selection" width="55"></el-table-column>
        <el-table-column label="Tên tài khoản">
          <template slot-scope="scope">
            <div class="v-h2">{{ _notag(scope.row.name) }}</div>
          </template>
        </el-table-column>
        <el-table-column label="Email">
          <template slot-scope="scope">
            <div>{{ scope.row.email }}</div>
          </template>
        </el-table-column>
        <el-table-column label="Số điện thoại">
          <template slot-scope="scope">
            <div>{{ scope.row.email }}</div>
          </template>
        </el-table-column>
        <el-table-column label="Ngày tạo">
          <template slot-scope="scope">
            <div>{{ _dateFormat(scope.row.created_at, 'short') }}</div>
          </template>
        </el-table-column>
        <el-table-column fixed="right" label="Thao tác" align="center" width="120">
          <template slot-scope="scope">
            <el-button type="primary" icon="el-icon-edit" size="small" title="Edit" circle @click="handleShow(scope.row)"></el-button>
            <el-button type="danger" icon="el-icon-delete" size="small" title="Delete" circle @click="handleDelete(scope.row)"></el-button>
          </template>
        </el-table-column>
      </el-table>
      <pagination :total="total" :controller="controller"></pagination>
    </div>
  </div>
</template>
<script>
import Edit from './Edit'
import Filters from '../../components/Filters'
import Pagination from '../../components/Pagination'
import { mapGetters, mapActions, mapState } from 'vuex'
import foo from '@/configs'

const CONTROLLER = 'user'

export default {
  data() {
    return {
      controller: CONTROLLER,
    }
  },
  computed: {
    ...mapState({
      isLoading: state => state.isLoading
    }),
    ...mapGetters({
      items: `${CONTROLLER}/getAll`,
      total: `${CONTROLLER}/getTotalList`,
      filters: `${CONTROLLER}/getFilter`
    })
  },
  created() {
    this.init()
  },
  methods: {
    ...mapActions(CONTROLLER, ['getList']),
    /**
     * Khởi tạo dữ liệu
     */
    init(){
      this.getList({})
    },
  },
  components: {
    Edit,
    Filters,
    Pagination,
  }
}
</script>
<style>
</style>