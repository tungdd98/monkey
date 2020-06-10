<template>
    <el-pagination
        v-if="total > 0 && filters.per_page !== 0"
        background
        class="v-pagination"
        layout="prev, pager, next"
        @current-change="handleCurrChange"
        :total="total"
        :page-size="filters.per_page"
    ></el-pagination>
</template>
<script>
export default {
    props: {
        controller: { type: String, default: '' },
        total: { type: Number, default: 0 },
    },
    computed: {
        filters() {
            return this.$store.getters[`${this.controller}/getFilter`]
        },
    },
    methods: {
        /**
         * Phân trang
         */
        handleCurrChange(val) {
            this.$store.dispatch(`${this.controller}/getList`, {
                page: val,
                order_by: this.filters.order_by,
                order_dir: this.filters.order_dir,
                per_page: this.filters.per_page,
            })
        },
    },
}
</script>
<style></style>
