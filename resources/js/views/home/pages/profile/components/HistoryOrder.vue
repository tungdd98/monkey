<template>
    <div class="ct-account">
        <h3 class="title-acc v2">Lịch sử mua hàng</h3>
        <div class="history-order">
            <table class="table">
                <tr class="text-center">
                    <th>Mã đơn hàng</th>
                    <th>Ngày mua</th>
                    <th>Số lượng</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                </tr>
                <tbody v-if="data">
                    <tr v-for="item in data" :key="item.id" class="text-center">
                        <td>
                            <a href @click.prevent="handleShow(item)">{{
                                "KR" + item.id
                            }}</a>
                        </td>
                        <td>{{ _dateFormat(item.created_at, "short") }}</td>
                        <td>{{ item.quantity }}</td>
                        <td>{{ _formatCurrency(item.total) }}</td>
                        <td>
                            <div class="v-h2" v-html="handleShowStatus(item)">
                                {{ handleShowStatus(item) }}
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="order-detail" v-if="currItem">
            <el-dialog
                :title="display.formTitle"
                :visible.sync="dialog.formVisible"
            >
                <div
                    class="d-flex justify-content-end mb-2"
                    v-if="currItem.status === 0"
                >
                    <div
                        class="btn btn-outline-danger btn-sm"
                        @click.prevent="handleChangeStatus"
                    >
                        Huỷ đơn hàng
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p>
                            Mã đơn hàng:
                            <span class="v-h2">{{ "KR" + currItem.id }}</span>
                        </p>
                        <p>
                            Trạng thái:
                            <span v-html="showStatus">{{ showStatus }}</span>
                        </p>
                    </div>
                    <div>
                        <p class="v-h2" style="font-size: 24px">
                            {{ _formatCurrency(currItem.total) }}
                        </p>
                    </div>
                </div>
                <hr />
                <div class="row kr-info">
                    <div class="col-md-6 kr-info__customer">
                        <p class="mb-2">THÔNG TIN NGƯỜI NHẬN</p>
                        <div class="kr-info__box">
                            <p class="v-h2" style="text-transform: uppercase">
                                {{ _notag(currItem.customer.name) }}
                            </p>
                            <p>
                                Địa chỉ: {{ _notag(currItem.customer.address) }}
                            </p>
                            <p>
                                Số điện thoại:
                                {{ _notag(currItem.customer.phone) }}
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6 kr-info__pay">
                        <p class="mb-2">HÌNH THỨC GIAO HÀNG</p>
                        <div class="kr-info__box">
                            <p>Thanh toán khi nhận hàng</p>
                            <p>
                                (Tomita Mart sẽ đến thu tiền và giao sản phẩm
                                tại địa chỉ của quý khách.)
                            </p>
                            <p>Chi phí vận chuyển: 0đ</p>
                        </div>
                    </div>
                </div>
                <div class="md-cart-tb mt-4">
                    <table>
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Tạm tính</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="item in currItem.products"
                                :key="item.id"
                            >
                                <td>
                                    <div class="if-pro-cart">
                                        <a class="img" href="#" title>
                                            <img
                                                :src="
                                                    _getThumbnail(
                                                        'product',
                                                        item.thumbnail
                                                    )
                                                "
                                                alt
                                                title
                                            />
                                        </a>
                                        <div class="ct">
                                            <span>{{
                                                _notag(item.title)
                                            }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <strong>{{
                                        item.original_price
                                            ? _formatCurrency(item.price)
                                            : _formatCurrency(
                                                  item.original_price
                                              )
                                    }}</strong>
                                    <del v-if="item.original_price">{{
                                        _formatCurrency(item.original_price)
                                    }}</del>
                                </td>
                                <td>{{ item.pivot.quantity }}</td>
                                <td>
                                    {{
                                        _formatCurrency(
                                            getToTalMoneyItem(
                                                item.pivot.quantity,
                                                item.price
                                            )
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
                            {{ _formatCurrency(getTotalMoney) }}</span
                        >
                        <span class="line">|</span>
                        <span class="transport">Phí vận chuyển: 0đ</span>
                        <span class="line">|</span>
                        <div class="total">
                            <p>
                                Tổng cộng:
                                <strong>{{
                                    _formatCurrency(getTotalMoney)
                                }}</strong>
                            </p>
                            <span>(Giá đã bao gồm thuế VAT)</span>
                        </div>
                    </div>
                </div>
            </el-dialog>
        </div>
    </div>
</template>
<script>
import { mapActions, mapState, mapGetters } from "vuex";
import foo from "@/configs";

export default {
    data() {
        return {
            foo,
            data: [],
            dialog: {
                formVisible: false
            },
            display: {
                formTitle: "Chi tiết đơn hàng"
            }
        };
    },
    computed: {
        ...mapGetters({
            currItem: "order/getCurrItem",
            user: "auth/getUser"
        }),
        /**
         * Hiển thị trạng thái giao hàng
         */
        showStatus() {
            return `<span style="color: ${
                foo.ORDER[this.currItem.status].color
            }">${foo.ORDER[this.currItem.status].label}</span>`;
        },
        getTotalMoney() {
            return this.currItem.products.reduce((sum, product) => {
                return sum + product.price * parseInt(product.pivot.quantity);
            }, 0);
        }
    },
    watch: {
        currItem(val, oldVal) {
            if (val) {
                this.dialog.formVisible = true;
            }
        },
        "dialog.formVisible"(val, oldVal) {
            if (!val) {
                this.$store.commit(`order/setCurrItem`, null);
            }
        }
    },
    created() {
        this.init();
    },
    methods: {
        ...mapActions("order", ["getList", "getItemById", "changeStatus"]),
        /**
         * Khởi tạo dữ liệu
         */
        init() {
            this.getList({ pagination: false }).then(res => {
                if (res.flag) {
                    this.data = res.data.data;
                }
            });
        },
        handleShowStatus(item) {
            return `<span style="color: ${foo.ORDER[item.status].color}">${
                foo.ORDER[item.status].label
            }</span>`;
        },
        /**
         * Hiển thị sản phẩm
         */
        handleShow(data) {
            this.getItemById(data.id).then(res => {
                if (!res.flag) {
                    this.$fire(foo.NOTIFICATION.error);
                } else {
                    // console.log(res.data)
                }
            });
        },
        /**
         * Tính tổng tiền từng sản phẩm
         */
        getToTalMoneyItem(quantity, price) {
            return parseInt(quantity) * price;
        },
        handleChangeStatus() {
            const data = {
                id: this.currItem.id,
                status: 3
            };
            this.changeStatus(data).then(res => {
                if (res.flag) {
                    this.$fire(foo.NOTIFICATION.success.updated);
                    this.dialog.formVisible = false;
                } else {
                    this.$fire(foo.NOTIFICATION.error);
                }
            });
        }
    }
};
</script>
<style scoped>
.order-detail .el-dialog {
    width: 70% !important;
}
</style>
