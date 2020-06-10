<template>
    <div>
        <a
            href
            title
            class="icon-cart"
            data-toggle="modal"
            data-target="#pu-cart"
        >
            <i class="fa fa-shopping-cart"></i>
            <span>{{ cart.totalQuantity }}</span>
        </a>
        <div class="modal popup-cart popup-primary fade" id="pu-cart">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="icon_close"></i>
                    </button>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <h3 class="title-cart">
                            giỏ hàng của bạn
                            <span>({{ cart.totalQuantity }} sản phẩm)</span>
                        </h3>
                        <div class="md-cart-tb">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                        <th>Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="item in cart.all"
                                        :key="item.product.id"
                                    >
                                        <td>
                                            <div class="if-pro-cart">
                                                <a class="img" href="#" title>
                                                    <img
                                                        :src="
                                                            _getThumbnail(
                                                                'product',
                                                                item.product
                                                                    .thumbnail
                                                            )
                                                        "
                                                        alt
                                                        title
                                                    />
                                                </a>
                                                <div class="ct">
                                                    <a
                                                        class="smooth title"
                                                        href="#"
                                                        title
                                                        >{{
                                                            item.product.title
                                                        }}</a
                                                    >
                                                    <a
                                                        class="smooth remove"
                                                        href="#"
                                                        title
                                                        @click.prevent="
                                                            handleDelete(item)
                                                        "
                                                    >
                                                        <i
                                                            class="icon_close"
                                                        ></i>
                                                        Bỏ sản phẩm
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span>{{
                                                item.product.original_price
                                                    ? _formatCurrency(
                                                          item.product
                                                              .original_price
                                                      )
                                                    : _formatCurrency(
                                                          item.product.price
                                                      )
                                            }}</span>
                                            <del
                                                v-show="
                                                    item.product.original_price
                                                "
                                                >{{
                                                    _formatCurrency(
                                                        item.product
                                                            .original_price
                                                    )
                                                }}</del
                                            >
                                        </td>
                                        <td>
                                            <div class="i-number">
                                                <button
                                                    class="n-ctrl down smooth"
                                                    @click.prevent="
                                                        handleDecrementQuantity(
                                                            item
                                                        )
                                                    "
                                                ></button>
                                                <input
                                                    type="text"
                                                    class="numberic"
                                                    min="1"
                                                    max="1000"
                                                    :value="item.quantity"
                                                />
                                                <button
                                                    class="n-ctrl up smooth"
                                                    @click.prevent="
                                                        handleIncrementQuantity(
                                                            item
                                                        )
                                                    "
                                                ></button>
                                            </div>
                                        </td>
                                        <td>
                                            {{
                                                _formatCurrency(
                                                    totalMoneyItem(item)
                                                )
                                            }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="md-cart-foot">
                            <div class="top">
                                <span class="total-provision"
                                    >Tổng tạm tính:
                                    {{ _formatCurrency(cart.totalMoney) }}</span
                                >
                                <span class="line">|</span>
                                <span class="transport"
                                    >Phí vận chuyển: 0đ</span
                                >
                                <span class="line">|</span>
                                <div class="total">
                                    <p>
                                        Tổng cộng:
                                        <strong>{{
                                            _formatCurrency(cart.totalMoney)
                                        }}</strong>
                                    </p>
                                    <span>(Giá đã bao gồm thuế VAT)</span>
                                </div>
                            </div>
                            <div class="bottom">
                                <div class="cell">
                                    <router-link
                                        :to="{
                                            name: 'Product',
                                            path: '/product'
                                        }"
                                        class="smooth ctrl-continue"
                                        data-dismiss="modal"
                                    >
                                        <i class="arrow_left"></i> Tiếp tục mua
                                        hàng
                                    </router-link>
                                </div>
                                <div class="cell" v-if="cart.all.length > 0">
                                    <router-link
                                        :to="handleGetLinkCheckOut"
                                        class="smooth ctrl-payment"
                                        data-dismiss="modal"
                                        >Gửi đơn hàng</router-link
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapGetters } from "vuex";
export default {
    data() {
        return {
            num: 1
        };
    },
    computed: {
        ...mapGetters({
            cart: "cart/getCart",
            user: "auth/getUser"
        }),
        handleGetLinkCheckOut() {
            if (this.user) {
                return {
                    name: "checkout"
                };
            }
            return {
                name: "information"
            };
        }
    },
    methods: {
        /**
         * Tính tổng tiền từng sản phẩm
         */
        totalMoneyItem(item) {
            return item.product.price * item.quantity;
        },
        /**
         * Giảm sản phẩm trong giỏ
         */
        handleDecrementQuantity(item) {
            this.$store.dispatch("cart/changeProductToCart", {
                product: item.product,
                quantity: -1
            });
        },
        /**
         * Tăng sản phẩm trong giỏ
         */
        handleIncrementQuantity(item) {
            this.$store.dispatch("cart/changeProductToCart", {
                product: item.product,
                quantity: 1
            });
        },
        /**
         * Xoá sản phẩm khỏi giỏ
         */
        handleDelete(item) {
            this.$store.dispatch("cart/deleteProductOutCart", item);
        }
    }
};
</script>
<style>
.el-input-number__decrease,
.el-input-number__increase {
    background: #f75510 !important;
    color: #fff !important;
}
</style>
