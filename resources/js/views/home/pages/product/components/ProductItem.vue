<template>
    <div class="col-lg-4 col-sm-6">
        <div class="item-product" v-if="item">
            <div class="hethang" v-if="item.quantity === 0">Hết hàng</div>
            <a href title class="img-primary">
                <img :src="_getThumbnail(controller, item.thumbnail)" alt />
            </a>
            <div class="ct">
                <h3 class="title">
                    <router-link
                        :title="_slug(item.title)"
                        :to="getLinkItem(item)"
                        >{{ _notag(item.title) }}</router-link
                    >
                </h3>
                <p class="note">
                    Nhà cung cấp: {{ _notag(item.supplier.title) }}
                </p>
                <div class="price">
                    <span>
                        <strong>{{
                            item.original_price
                                ? _formatCurrency(item.price)
                                : _formatCurrency(item.original_price)
                        }}</strong
                        >{{ `/${_notag(item.unit.title)}` }}
                    </span>
                    <del v-show="item.original_price"
                        >{{ _formatCurrency(item.original_price)
                        }}{{ `/${_notag(item.unit.title)}` }}</del
                    >
                </div>
            </div>
            <span class="sales" v-show="getSale > 0">-{{ getSale }}%</span>
            <div href class="control">
                <a
                    href
                    title
                    class="add-cart btn-crt"
                    @click.prevent="handleAddCart(item)"
                >
                    <i class="fa fa-cart-plus"></i>
                </a>
                <router-link
                    :title="_slug(item.title)"
                    :to="getLinkItem(item)"
                    class="view-details btn-crt"
                >
                    <i class="fa fa-external-link"></i>
                </router-link>
                <router-link :to="getLinkItem(item)" class="link"></router-link>
            </div>
        </div>
    </div>
</template>
<script>
import { mapActions } from "vuex";
export default {
    data() {
        return {
            info: {
                unit: "",
                supplier: ""
            }
        };
    },
    computed: {
        getSale() {
            return Math.floor(this.item.price / this.item.original_price) * 100;
        }
    },
    props: {
        item: { type: Object, default: {} },
        controller: { type: String, default: "" }
    },
    created() {},
    methods: {
        ...mapActions("product", ["getPropertyById"]),
        /**
         * Lấy link sản phẩm
         */
        getLinkItem(item) {
            return {
                name: "product-detail",
                params: {
                    id: item.id
                }
            };
        },
        /**
         * Thêm sản phẩm vào giỏ
         */
        handleAddCart(item) {
            this.$store.dispatch("cart/changeProductToCart", {
                product: item,
                quantity: 1
            });
        }
    }
};
</script>
<style scoped>
.hethang {
    position: absolute;
    top: 10px;
    right: 10px;
    background-color: #ab3434;
    color: #fff;
    padding: 10px 12px;
    z-index: 10;
}
</style>
