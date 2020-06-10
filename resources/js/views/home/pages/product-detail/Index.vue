<template>
    <section class="page-product-dt page-primary v2">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">Trang chủ</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#">Sản phẩm</a>
                    </li>
                    <li
                        class="breadcrumb-item active"
                        aria-current="page"
                        v-if="item"
                    >
                        {{ _notag(item.title) }}
                    </li>
                </ol>
            </nav>
            <div class="details-product">
                <div class="row">
                    <div class="col-lg-6">
                        <product-images :item="item"></product-images>
                    </div>
                    <div class="col-lg-6">
                        <product-content
                            :item="item"
                            :id="id"
                        ></product-content>
                    </div>
                </div>
                <product-intro :item="item"></product-intro>
            </div>
            <product-related></product-related>
        </div>
    </section>
</template>
<script>
import ProductRelated from "./components/ProductRelated";
import ProductIntro from "./components/ProductIntro";
import ProductImages from "./components/ProductImages";
import ProductContent from "./components/ProductContent";
import { mapActions, mapGetters } from "vuex";
export default {
    data() {
        return {
            id: this.$route.params.id
        };
    },
    watch: {
        $route(to, from) {
            this.id = to.params.id;
            this.getItemById(this.id);
        }
    },
    computed: {
        ...mapGetters({
            item: "product/getCurrItem"
        })
    },
    created() {
        this.getItemById(this.id);
    },
    methods: {
        ...mapActions("product", ["getItemById", "getPropertyById"])
    },
    components: {
        ProductRelated,
        ProductIntro,
        ProductImages,
        ProductContent
    }
};
</script>
<style>
.sl-arrow {
    bottom: calc(100% + 5px) !important;
}
</style>
