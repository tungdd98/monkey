<template>
    <div class="ct-account">
        <h3 class="title-acc">thông tin cá nhân</h3>
        <el-form :model="form" :rules="rules" ref="update">
            <el-form-item
                label="Email"
                :label-width="display.formLabelWidth"
                prop="email"
            >
                <el-input
                    v-model="form.email"
                    autocomplete="off"
                    :disabled="true"
                >
                    <i slot="suffix" class="el-input__icon el-icon-edit"></i>
                </el-input>
            </el-form-item>
            <el-form-item
                label="Tên tài khoản"
                :label-width="display.formLabelWidth"
                prop="name"
            >
                <el-input v-model="form.name" autocomplete="off">
                    <i slot="suffix" class="el-input__icon el-icon-edit"></i>
                </el-input>
            </el-form-item>
            <el-row :gutter="20">
                <el-col :span="12">
                    <el-form-item
                        label="Giới tính"
                        :label-width="display.formLabelWidth"
                        prop="gender"
                    >
                        <el-select v-model="form.gender" placeholder="--Chọn--">
                            <el-option value="1" label="Nam"></el-option>
                            <el-option value="0" label="Nữ"></el-option>
                        </el-select>
                    </el-form-item>
                </el-col>
                <el-col :span="12">
                    <el-form-item
                        label="Ngày sinh"
                        :label-width="display.formLabelWidth"
                        prop="birthday"
                        class="pull-right"
                    >
                        <el-date-picker
                            v-model="form.birthday"
                            type="date"
                            placeholder="--Chọn--"
                        ></el-date-picker>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-form-item
                label="Số điện thoại"
                :label-width="display.formLabelWidth"
                prop="phone"
            >
                <el-input v-model="form.phone" autocomplete="off">
                    <i slot="suffix" class="el-input__icon el-icon-edit"></i>
                </el-input>
            </el-form-item>
            <el-row :gutter="10">
                <el-col :span="8">
                    <el-form-item
                        label="Tỉnh/ Thành"
                        :label-width="display.formLabelWidth"
                    >
                        <el-select
                            v-model="address.city"
                            placeholder="--Chọn--"
                            filterable
                        >
                            <el-option
                                v-for="item in City"
                                :key="item.code"
                                :label="item.name"
                                :value="item.code"
                            ></el-option>
                        </el-select>
                    </el-form-item>
                </el-col>
                <el-col :span="8">
                    <el-form-item
                        label="Quận/ Huyện"
                        :label-width="display.formLabelWidth"
                    >
                        <el-select
                            v-model="address.district"
                            placeholder="--Chọn--"
                            filterable
                        >
                            <el-option
                                v-for="item in filterDistrict"
                                :key="item[1].code"
                                :label="item[1].name"
                                :value="item[1].code"
                            ></el-option>
                        </el-select>
                    </el-form-item>
                </el-col>
                <el-col :span="8">
                    <el-form-item
                        label="Xã/ Phường"
                        :label-width="display.formLabelWidth"
                    >
                        <el-select
                            v-model="address.ward"
                            placeholder="--Chọn--"
                            filterable
                        >
                            <el-option
                                v-for="item in filterWard"
                                :key="item[1].code"
                                :label="item[1].name"
                                :value="item[1].code"
                            ></el-option>
                        </el-select>
                    </el-form-item>
                </el-col>
            </el-row>
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
                    <i slot="suffix" class="el-input__icon el-icon-edit"></i>
                </el-input>
            </el-form-item>
        </el-form>
        <div class="form-group pull-right">
            <span class="empty">&nbsp;</span>
            <button
                class="btn-account"
                type="button"
                @click.prevent="handleSubmit"
            >
                Cập nhật
            </button>
        </div>
    </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
import * as District from "@/location/quan_huyen.json";
import * as City from "@/location/tinh_tp.json";
import * as Ward from "@/location/xa_phuong.json";
import foo from "@/configs";

export default {
    data() {
        return {
            City: City.default,
            District: District.default,
            Ward: Ward.default,
            display: {
                formTitle: "Thêm mới",
                formLabelWidth: "120px"
            },
            rules: {},
            form: {
                name: "",
                email: "",
                phone: "",
                address: "",
                gender: "",
                level: 0
            },
            address: {
                city: "",
                district: "",
                ward: ""
            }
        };
    },
    computed: {
        ...mapGetters({
            user: "auth/getUser"
        }),
        filterDistrict() {
            return Object.entries(this.District).filter(
                ([key, value]) => value.parent_code === this.address.city
            );
        },
        filterWard() {
            return Object.entries(this.Ward).filter(
                ([key, value]) => value.parent_code === this.address.district
            );
        }
    },
    mounted() {
        Object.entries(this.user).forEach(([key, value]) => {
            if (
                [
                    "email",
                    "name",
                    "address",
                    "phone",
                    "gender",
                    "birthday"
                ].includes(key)
            ) {
                this.form[key] = value;
            } else {
                this.address[key] = value;
            }
        });
    },
    methods: {
        ...mapActions("user", ["updateItem"]),
        handleSubmit() {
            this.$refs.update.validate(valid => {
                if (valid) {
                    let data = new FormData();
                    Object.entries(this.form).forEach(([key, value]) =>
                        data.append(key, value)
                    );
                    Object.entries(this.address).forEach(([key, value]) =>
                        data.append(key, value)
                    );
                    data.append("id", this.user.id);
                    data.append("field", "update-item");
                    data.append("status", 1);
                    this.updateItem(data).then(res => {
                        if (res.flag) {
                            this.$fire(foo.NOTIFICATION.success.updated);
                        } else {
                            let errors = res.msg.response.data.errors;
                            this._showErrors(errors);
                        }
                    });
                }
            });
        }
    }
};
</script>
<style></style>
