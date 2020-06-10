<template>
    <nav aria-label="Page navigation">
        <el-pagination
            v-if="total > 0"
            background
            class="kr-pagination"
            layout="prev, pager, next"
            @current-change="handleCurrChange"
            :page-size="9"
            :total="total"
        ></el-pagination>
    </nav>
</template>
<script>
import { mapActions, mapGetters } from "vuex";
export default {
    props: {
        tag: { type: [String, Number], default: "" },
        total: { type: Number, default: 0 }
    },
    methods: {
        ...mapActions("product", ["getListTomita"]),
        handleCurrChange(val) {
            this.getListTomita({
                tag: this.tag,
                page: val
            });
        }
    }
};
</script>
<style lang="scss">
.kr-pagination {
    display: flex;
    justify-content: center;
    background: #fff;
    padding: 5px 0 !important;
    &.is-background .el-pager li:not(.disabled).active {
        background-color: #f75510 !important;
    }
}
</style>
