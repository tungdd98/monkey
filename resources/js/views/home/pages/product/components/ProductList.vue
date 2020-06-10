<template>
    <div class="list-product">
        <div class="head">
            <h3 class="title-pro">Tất cả</h3>
            <product-filter></product-filter>
        </div>
        <div class="row" v-if="total > 0">
            <product-item
                v-for="item in items"
                :key="item.id"
                :item="item"
                :controller="controller"
            ></product-item>
        </div>
        <div v-else class="d-flex justify-content-center m-5">
            <span>Không có sản phẩm</span>
        </div>
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
    </div>
</template>
<script>
import ProductItem from "./ProductItem";
import ProductPagination from "./ProductPagination";
import ProductFilter from "./ProductFilter";
import { mapActions, mapGetters } from "vuex";

const CONTROLLER = "product";

export default {
    data() {
        return {
            controller: CONTROLLER,
            tag: this.$route.query.tag
        };
    },
    computed: {
        ...mapGetters({
            items: `${CONTROLLER}/getAll`,
            total: `${CONTROLLER}/getTotalList`
        })
    },
    watch: {
        $route(to, from) {
            this.tag = to.query.tag;
            this.init();
        }
    },
    created() {
        this.init();
    },
    methods: {
        ...mapActions(CONTROLLER, ["getListTomita"]),
        init() {
            this.getListTomita({ tag: this.tag, page: 1 });
        },
        handleCurrChange(val) {
            this.getListTomita({
                tag: this.tag,
                page: val
            });
        }
    },
    components: {
        ProductItem,
        ProductPagination,
        ProductFilter
    }
};
</script>
<style></style>
