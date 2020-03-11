<template>
  <div class="v-filter">
    <el-select v-model="filter" placeholder="-- Sắp xếp theo --" size="small" @change="handleChangeSort">
      <el-option
        v-for="item in optionsSort"
        :key="item.id"
        :label="item.title"
        :value="item.id"
      ></el-option>
    </el-select>
    <el-select v-model="count" placeholder="-- Số bản ghi --" size="small" style="width: 120px" @change="handleChangeCount">
      <el-option
        v-for="item in optionsPaginate"
        :key="item.value"
        :label="item.title"
        :value="item.value"
      ></el-option>
    </el-select>
  </div>
</template>
<script>
import { mapActions } from 'vuex'
import foo from '@/configs'
export default {
  data() {
    return {
      filter: '',
      count: foo.PAGINATE.per_page,
      optionsSort: [
        {
          id: 0,
          title: 'A-Z',
          value: {
            order_by: 'title',
            order_dir: 'asc'
          }
        },
        {
          id: 1,
          title: 'Z-A',
          value: {
            order_by: 'title',
            order_dir: 'desc'
          }
        },
        {
          id: 2,
          title: 'Ngày tạo gần đây',
          value: {
            order_by: 'created_at',
            order_dir: 'desc'
          }
        }
      ],
      optionsPaginate: [
        {
          title: '2',
          value: 2
        },
        {
          title: '5',
          value: 5
        },
        {
          title: '10',
          value: 10
        },
        {
          title: '20',
          value: 20
        },
        {
          title: '50',
          value: 50
        },
        {
          title: '100',
          value: 100
        },
        {
          title: 'Tất cả',
          value: 'all'
        }
      ]
    }
  },
  methods: {
    ...mapActions('slider', ['getList']),
    /**
     * Lọc theo số bản ghi
     */
    handleChangeCount() {
      if(this.count === 'all') {
        this.getList({
          pagination: false
        })
      } else {
        this.getList({
          per_page: this.count
        })
      }
    },
    /**
     * Lọc theo những options còn lại
     */
    handleChangeSort() {
      let demo = this.optionsSort.filter(option => option.id === this.filter)
      this.getList({
        order_by: demo[0].value.order_by,
        order_dir: demo[0].value.order_dir
      })
    }
  }
}
</script>
<style>
</style>