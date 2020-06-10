<template>
    <div class="v-filter">
        <el-select
            v-model="filter"
            placeholder="-- Sắp xếp theo --"
            size="small"
            @change="handleFilterState()"
        >
            <el-option
                v-for="item in optionsSort"
                :key="item.id"
                :label="item.title"
                :value="item.id"
            ></el-option>
        </el-select>
        <el-select
            v-model="count"
            placeholder="-- Số bản ghi --"
            size="small"
            style="width: 140px"
            @change="handleFilterPerPage()"
        >
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
import foo from '@/configs'
import { mapState } from 'vuex'
export default {
    data() {
        return {
            filter: '',
            count: '',
            optionsSort: foo.FILTER.order,
            optionsPaginate: foo.FILTER.per_page,
        }
    },
    props: {
        controller: { type: String, default: '' },
    },
    computed: {
        filters() {
            return this.$store.getters[`${this.controller}/getFilter`]
        },
    },
    methods: {
        /**
         * Lọc theo options
         */
        handleFilterState() {
            let idx = this.optionsSort.findIndex(
                option => option.id === this.filter
            )
            let order = this.optionsSort[idx].value
            this.$store.dispatch(`${this.controller}/getList`, {
                per_page: this.filters.per_page,
                order_by: order.order_by,
                order_dir: order.order_dir,
            })
        },
        /**
         * Lọc theo số bản ghi
         */
        handleFilterPerPage() {
            this.$store.dispatch(`${this.controller}/getList`, {
                per_page: this.count,
                order_by: this.filters.order_by,
                order_dir: this.filters.order_dir,
            })
        },
    },
}
</script>
<style></style>
