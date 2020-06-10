<template>
    <div class="page-checkout">
        <router-link v-if="!user" :to="{ name: 'information' }" class="back-btn"
            ><i class="el-icon-back"></i> Quay lại</router-link
        >
        <div class="card">
            <div class="card-header">
                <h4>
                    <strong>
                        <i class="el-icon-user-solid"></i> THÔNG TIN ĐƠN HÀNG
                    </strong>
                </h4>
            </div>
            <div class="card-body checkout">
                <div class="checkout__table table-responsive">
                    <h4 class="checkout__title">Thông tin đặt hàng</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">
                                    Mã sản phẩm
                                </th>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Đơn giá</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in cart.all" :key="item.product.id">
                                <th scope="row" class="text-center">
                                    {{ _notag(item.product.code) }}
                                </th>
                                <td>{{ item.product.title }}</td>
                                <td>
                                    {{
                                        item.product.original_price
                                            ? _formatCurrency(
                                                  item.product.original_price
                                              )
                                            : _formatCurrency(
                                                  item.product.price
                                              )
                                    }}
                                </td>
                                <td>{{ item.quantity }}</td>
                                <td>
                                    {{ _formatCurrency(totalMoneyItem(item)) }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <th>Phí vận chuyển</th>
                                <td>0đ</td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <th>Tổng tiền</th>
                                <td>{{ _formatCurrency(cart.totalMoney) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="checkout__customer" v-if="user || customer">
                    <h4 class="checkout__title">Thông tin khách hàng</h4>
                    <div class="row mb-2">
                        <div class="col-md-3">
                            <span class="checkout__label">Tên khách hàng:</span>
                        </div>
                        <div class="col-md-9">
                            <span>{{
                                user ? _notag(user.name) : _notag(customer.name)
                            }}</span>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3">
                            <span class="checkout__label">Địa chỉ:</span>
                        </div>
                        <div class="col-md-9">
                            <span>{{
                                user
                                    ? _notag(user.address)
                                    : _notag(customer.address)
                            }}</span>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3">
                            <span class="checkout__label">Email:</span>
                        </div>
                        <div class="col-md-9">
                            <span>{{
                                user
                                    ? _notag(user.email)
                                    : _notag(customer.email)
                            }}</span>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3">
                            <span class="checkout__label">Số điện thoại:</span>
                        </div>
                        <div class="col-md-9">
                            <span>{{
                                user
                                    ? _notag(user.phone)
                                    : _notag(customer.phone)
                            }}</span>
                        </div>
                    </div>
                </div>
                <div class="checkout__more">
                    <h4 class="checkout__title">Thông tin thanh toán</h4>
                    <div class="row mb-2">
                        <div class="col-md-3">
                            <span class="checkout__label"
                                >Hình thức thanh toán:</span
                            >
                        </div>
                        <div class="col-md-9">
                            <span>Trả tiền mặt</span>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3">
                            <span class="checkout__label"
                                >Ngày hẹn giao hàng:</span
                            >
                        </div>
                        <div class="col-md-9">
                            <span>13/10/2020</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="checkout__btn" @click="handleSubmit">
                    Hoàn tất đơn hàng
                </button>
            </div>
        </div>
    </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
import foo from "@/configs";
export default {
    computed: {
        ...mapGetters({
            user: "auth/getUser",
            cart: "cart/getCart",
            customer: "cart/getCustomer"
        })
    },
    methods: {
        ...mapActions("cart", ["addCart"]),
        /**
         * Tính tổng tiền từng sản phẩm
         */
        totalMoneyItem(item) {
            return item.product.price * item.quantity;
        },
        handleSubmit() {
            const data = new FormData();
            if (this.user) {
                data.append("user_id", this.user.id);
            }
            if (this.customer) {
                data.append("isCustomer", true);
                Object.entries(this.customer).forEach(([key, value]) =>
                    data.append(key, value)
                );
            }
            data.append("total", this.cart.totalMoney);
            data.append("quantity", this.cart.totalQuantity);
            this.cart.all.forEach((value, key) => {
                data.append(`products[${key}]`, [
                    value.product.id,
                    value.quantity
                ]);
            });
            this.$fire(foo.NOTIFICATION.confirm.addCart).then(res => {
                if (res.value) {
                    this.addCart(data).then(res => {
                        if (res.flag) {
                            foo.NOTIFICATION.success.addCart.timer = 5000;
                            this.$fire(foo.NOTIFICATION.success.addCart);
                            this.$router.push("/");
                        } else this.$fire(foo.NOTIFICATION.error);
                    });
                }
            });
        }
    }
};
</script>
<style lang="scss" scoped>
.checkout__title {
    font-weight: 600;
    border-bottom: 1px solid #ddd;
    padding-bottom: 10px;
    margin-bottom: 10px;
}
.back-btn {
    display: inline-block;
    padding: 5px 10px;
    margin-bottom: 10px;
    border: 1px solid #f75510;
    border-radius: 5px;
    color: #f75510;
}
</style>
