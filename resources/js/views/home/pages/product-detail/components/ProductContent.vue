<template>
    <div class="info-pro-dt" v-if="item">
        <h1 class="title-pro">{{ _notag(item.title) }}</h1>
        <div class="price">
            <strong>{{
                item.original_price
                    ? _formatCurrency(item.original_price)
                    : _formatCurrency(item.price)
            }}</strong
            >{{ `/${info.unit}` }}
            <del v-show="item.original_price"
                >{{ _formatCurrency(item.original_price)
                }}{{ `/${info.unit}` }}</del
            >
        </div>
        <div class="desc" v-html="item.description">{{ item.description }}</div>
        <ul class="pro-properties clearfix">
            <li>
                <strong>Mã sản phẩm: </strong
                >{{ item.code ? _notag(item.code) : "" }}
            </li>
            <li><strong>Đơn vị tính: </strong>{{ _notag(info.unit) }}</li>
            <li><strong>Nhà sản xuất: </strong>{{ _notag(info.supplier) }}</li>
            <li>
                <strong>Trạng thái: </strong
                >{{ item.quantity > 0 ? "Còn hàng" : "Hết hàng" }}
            </li>
        </ul>
        <div class="pro-quantity">
            <span>Số lượng: {{ item.quantity }}</span>
            <div class="i-number">
                <button
                    class="n-ctrl down smooth"
                    @click.prevent="handleDecrementQuantity"
                ></button>
                <input
                    type="text"
                    class="numberic"
                    min="1"
                    max="1000"
                    value="1"
                    v-model="number"
                />
                <button
                    class="n-ctrl up smooth"
                    @click.prevent="handleIncrementQuantity"
                ></button>
            </div>
        </div>
        <div class="btn-addcart">
            <a href title @click.prevent="handleAddCart">Thêm vào giỏ hàng</a>
        </div>
        <div class="pro-socials">
            <span>Chia sẻ :</span>
            <ul>
                <li>
                    <a href title>
                        <i class="social_facebook"></i>
                    </a>
                </li>
                <li>
                    <a href title>
                        <i class="social_twitter"></i>
                    </a>
                </li>
                <li>
                    <a href title>
                        <i class="social_googleplus"></i>
                    </a>
                </li>
                <li>
                    <a href title>
                        <i class="social_youtube"></i>
                    </a>
                </li>
            </ul>
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
            },
            number: 1
        };
    },
    props: {
        item: { type: Object, default: {} },
        id: { type: [Number, String] }
    },
    computed: {
        getSale() {
            return Math.floor(this.item.price / this.item.original_price) * 100;
        }
    },
    created() {
        ["unit", "supplier"].forEach(value => {
            this.getPropertyById({ id: this.id, property: value }).then(res => {
                if (res.flag && res.data.length > 0) {
                    this.info[value] = res.data[0].title;
                }
            });
        });
    },
    methods: {
        ...mapActions("product", ["getPropertyById"]),
        /**
         * Giảm sản phẩm trong giỏ
         */
        handleDecrementQuantity() {
            this.number--;
        },
        /**
         * Tăng sản phẩm trong giỏ
         */
        handleIncrementQuantity() {
            this.number++;
        },
        handleAddCart() {
            this.$store.dispatch("cart/changeProductToCart", {
                product: this.item,
                quantity: parseInt(this.number)
            });
        }
    }
};
</script>
<style></style>
