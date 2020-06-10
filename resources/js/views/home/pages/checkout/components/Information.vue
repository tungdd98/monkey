<template>
    <div class="page-information">
        <div class="card">
            <div class="card-header">
                <h4>
                    <strong>
                        <i class="el-icon-user-solid"></i> THÔNG TIN VẬN CHUYỂN
                    </strong>
                </h4>
            </div>
            <div class="card-body information">
                <el-row :gutter="20">
                    <el-col :span="16">
                        <el-form :model="form" :rules="rules" ref="information">
                            <el-form-item
                                label="Họ và tên"
                                :label-width="display.formLabelWidth"
                                prop="name"
                            >
                                <el-input
                                    v-model="form.name"
                                    autocomplete="off"
                                >
                                    <i
                                        slot="suffix"
                                        class="el-input__icon el-icon-edit"
                                    ></i>
                                </el-input>
                            </el-form-item>
                            <el-form-item
                                label="Giới tính"
                                :label-width="display.formLabelWidth"
                                prop="gender"
                            >
                                <el-select
                                    v-model="form.gender"
                                    placeholder="--Chọn--"
                                >
                                    <el-option
                                        value="1"
                                        label="Nam"
                                    ></el-option>
                                    <el-option value="0" label="Nữ"></el-option>
                                </el-select>
                            </el-form-item>
                            <el-form-item
                                label="Email"
                                :label-width="display.formLabelWidth"
                                prop="email"
                            >
                                <el-input
                                    v-model="form.email"
                                    autocomplete="off"
                                >
                                    <i
                                        slot="suffix"
                                        class="el-input__icon el-icon-edit"
                                    ></i>
                                </el-input>
                            </el-form-item>
                            <el-form-item
                                label="Số điện thoại"
                                :label-width="display.formLabelWidth"
                                prop="phone"
                            >
                                <el-input
                                    v-model="form.phone"
                                    autocomplete="off"
                                >
                                    <i
                                        slot="suffix"
                                        class="el-input__icon el-icon-edit"
                                    ></i>
                                </el-input>
                            </el-form-item>
                            <el-form-item
                                label="Địa chỉ"
                                :label-width="display.formLabelWidth"
                                prop="address"
                            >
                                <el-input
                                    v-model="form.address"
                                    autocomplete="off"
                                    type="textarea"
                                >
                                    <i
                                        slot="suffix"
                                        class="el-input__icon el-icon-edit"
                                    ></i>
                                </el-input>
                            </el-form-item>
                        </el-form>
                    </el-col>
                    <el-col :span="8">
                        <div class="Yorder">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th colspan="2">Giỏ hàng của bạn</th>
                                    </tr>
                                </thead>
                                <tbody v-if="cart.all.length > 0">
                                    <tr
                                        v-for="item in cart.all"
                                        :key="item.product.id"
                                    >
                                        <td>
                                            {{ _notag(item.product.title) }} x
                                            {{ item.quantity }}
                                        </td>
                                        <td class="text-right">
                                            {{
                                                _formatCurrency(
                                                    item.quantity *
                                                        item.product.price
                                                )
                                            }}
                                        </td>
                                    </tr>
                                </tbody>
                                <tr>
                                    <td>Tạm tính</td>
                                    <td class="text-right">
                                        {{
                                            cart.totalMoney > 0
                                                ? _formatCurrency(
                                                      cart.totalMoney
                                                  )
                                                : 0
                                        }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Phí ship</td>
                                    <td class="text-right">0đ</td>
                                </tr>
                            </table>

                            <button @click.prevent="handleSaveInformation">
                                Tiếp tục
                            </button>
                        </div>
                    </el-col>
                </el-row>
            </div>
        </div>
    </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
import foo from "@/configs";
export default {
    data() {
        return {
            form: {
                name: "",
                email: "",
                phone: "",
                address: "",
                birthday: "",
                gender: ""
            },
            rules: {
                name: foo.RULES.register.name,
                phone: foo.RULES.register.phone,
                address: foo.RULES.register.address,
                email: foo.RULES.register.email
            },
            display: {
                formLabelWidth: "120px"
            }
        };
    },
    computed: {
        ...mapGetters({
            cart: "cart/getCart",
            customer: "cart/getCustomer"
        })
    },
    created() {
        if (this.customer) {
            Object.entries(this.customer).forEach(([key, value]) => {
                this.form[key] = value;
            });
        }
    },
    methods: {
        handleSaveInformation() {
            this.$refs.information.validate(valid => {
                if (valid) {
                    this.$store
                        .dispatch("cart/addCustomer", this.form)
                        .then(res => {
                            if (res.flag) {
                                this.$router.push({ name: "checkout" });
                            }
                        });
                } else {
                    foo.NOTIFICATION.error.title = "Còn thiếu thông tin";
                    this.$fire(foo.NOTIFICATION.error);
                }
            });
        }
    }
};
</script>
<style lang="scss" scoped>
button {
    width: 100%;
    margin-top: 10px;
    padding: 10px;
    border: none;
    border-radius: 30px;
    background: #f75510;
    color: #fff;
    font-size: 15px;
    font-weight: bold;
    border: 1px solid #f75510;
    transition: 0.5s;
}
button:hover {
    cursor: pointer;
    background: #fff;
    color: #f75510;
}
</style>
