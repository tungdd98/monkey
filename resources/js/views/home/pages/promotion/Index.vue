<template>
    <section class="page-promotion page-primary">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">Trang chủ</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Khuyến mãi
                    </li>
                </ol>
            </nav>
            <h2 class="head-primary">Khuyến mãi</h2>
            <h3 class="title-promotion">Tin khuyến mãi</h3>
            <div class="row">
                <div class="col-md-6">
                    <div class="block-qc">
                        <a href title>
                            <img src="tomita/images/bn-qc3.jpg" alt />
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="block-qc">
                        <a href title>
                            <img src="tomita/images/bn-qc4.jpg" alt />
                        </a>
                    </div>
                </div>
            </div>
            <h3 class="title-promotion v2">Sản phẩm khuyến mãi</h3>
            <div class="row" v-if="items && items.length">
                <div
                    class="col-lg-3 col-sm-6"
                    v-for="item in items"
                    :key="item.id"
                >
                    <div class="item-product">
                        <a href title class="img-primary">
                            <img
                                :src="_getThumbnail('product', item.thumbnail)"
                                alt
                            />
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
                                            : _formatCurrency(
                                                  item.original_price
                                              )
                                    }}</strong>
                                    {{ `/${_notag(item.unit.title)}` }}
                                </span>
                                <del v-show="item.original_price"
                                    >{{ _formatCurrency(item.original_price)
                                    }}{{ `/${_notag(item.unit.title)}` }}</del
                                >
                            </div>
                        </div>
                        <span class="sales" v-show="getSale(item) > 0"
                            >-{{ getSale(item) }}%</span
                        >
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
                            <router-link
                                :to="getLinkItem(item)"
                                class="link"
                            ></router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
export default {
    name: "product-promotion",
    data() {
        return {
            items: []
        };
    },
    async created() {
        await this.$store.dispatch("product/getListPromotion").then(res => {
            this.items = res.data;
        });
    },
    computed: {},
    methods: {
        getLinkItem(item) {
            return {
                name: "product-detail",
                params: {
                    id: item.id
                }
            };
        },
        handleAddCart(item) {
            this.$store.dispatch("cart/changeProductToCart", {
                product: item,
                quantity: 1
            });
        },
        getSale(item) {
            return Math.floor(item.price / item.original_price) * 100;
        }
    }
};
</script>
<style></style>
