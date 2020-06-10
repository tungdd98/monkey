<template>
    <div class="v-products-dialog">
        <div class="v-products-dialog__add">
            <el-button type="primary" @click="dialog.formVisible = true">
                Thêm mới
                <i class="el-icon-document-add"></i>
            </el-button>
            <div class="v-products-dialog__form">
                <el-dialog
                    :title="display.formTitle"
                    :visible.sync="dialog.formVisible"
                    :show-close="false"
                >
                    <el-form :model="form" :rules="rules" :ref="controller">
                        <el-row :gutter="20">
                            <el-col :span="20">
                                <el-form-item
                                    label="Tên tài khoản"
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
                                <el-row :gutter="20">
                                    <el-col :span="8">
                                        <el-form-item
                                            label="Giới tính"
                                            :label-width="
                                                display.formLabelWidth
                                            "
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
                                                <el-option
                                                    value="0"
                                                    label="Nữ"
                                                ></el-option>
                                            </el-select>
                                        </el-form-item>
                                    </el-col>
                                    <el-col :span="8">
                                        <el-form-item
                                            label="Ngày sinh"
                                            :label-width="
                                                display.formLabelWidth
                                            "
                                            prop="birthday"
                                        >
                                            <el-date-picker
                                                v-model="form.birthday"
                                                type="date"
                                                placeholder="--Chọn--"
                                            ></el-date-picker>
                                        </el-form-item>
                                    </el-col>
                                    <el-col :span="8">
                                        <el-form-item
                                            label="Level"
                                            :label-width="
                                                display.formLabelWidth
                                            "
                                            prop="gender"
                                            style="float: right"
                                        >
                                            <el-select
                                                v-model="form.level"
                                                placeholder="--Chọn--"
                                            >
                                                <el-option
                                                    v-for="item in level.select"
                                                    :key="item.value"
                                                    :label="item.label"
                                                    :value="item.value"
                                                ></el-option>
                                            </el-select>
                                        </el-form-item>
                                    </el-col>
                                </el-row>
                                <el-form-item
                                    label="Email"
                                    :label-width="display.formLabelWidth"
                                    prop="email"
                                >
                                    <el-input
                                        v-model="form.email"
                                        autocomplete="off"
                                        :disabled="isEdit"
                                    >
                                        <i
                                            slot="suffix"
                                            class="el-input__icon el-icon-edit"
                                        ></i>
                                    </el-input>
                                </el-form-item>
                                <el-form-item
                                    label="Mật khẩu"
                                    :label-width="display.formLabelWidth"
                                    prop="password"
                                    v-if="!isEdit"
                                >
                                    <el-input
                                        v-model="form.password"
                                        autocomplete="off"
                                        type="password"
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
                                <el-row :gutter="10">
                                    <el-col :span="8">
                                        <el-form-item
                                            label="Tỉnh/ Thành phố"
                                            :label-width="
                                                display.formLabelWidth
                                            "
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
                                            :label-width="
                                                display.formLabelWidth
                                            "
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
                                            :label-width="
                                                display.formLabelWidth
                                            "
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
                                        <i
                                            slot="suffix"
                                            class="el-input__icon el-icon-edit"
                                        ></i>
                                    </el-input>
                                </el-form-item>
                            </el-col>
                            <el-col :span="4">
                                <el-form-item
                                    label="Hiển thị"
                                    :label-width="display.formLabelWidth"
                                >
                                    <el-switch
                                        v-model="state.status"
                                    ></el-switch>
                                </el-form-item>
                            </el-col>
                        </el-row>
                    </el-form>
                    <span slot="footer" class="dialog-footer">
                        <el-button size="small" @click="handleReset(controller)"
                            >Huỷ bỏ</el-button
                        >
                        <el-button
                            type="success"
                            size="small"
                            @click="handleSubmit(controller)"
                            >Lưu lại</el-button
                        >
                    </span>
                </el-dialog>
            </div>
        </div>
    </div>
</template>
<script>
import ClassicEditor from '@ckeditor/ckeditor5-build-classic'
import foo from '@/configs'
import { mapActions, mapGetters } from 'vuex'

import * as District from '@/location/quan_huyen.json'
import * as City from '@/location/tinh_tp.json'
import * as Ward from '@/location/xa_phuong.json'

const CONTROLLER = 'user'
export default {
    data() {
        const validateRepassword = function(rule, value, callback) {
            if (value !== this.password) {
                callback(new Error('Mật khẩu nhập lại không đúng'))
            }
        }
        return {
            City: City.default,
            District: District.default,
            Ward: Ward.default,
            address: {
                city: '',
                district: '',
                ward: '',
            },
            isEdit: false,
            isChangePassword: false,
            dialog: {
                formVisible: false,
            },
            display: {
                formTitle: 'Thêm mới',
                formLabelWidth: '130px',
            },
            rules: {
                name: foo.RULES.register.name,
                email: foo.RULES.register.email,
                password: foo.RULES.register.password,
                rePassword: [
                    { validator: validateRepassword, trigger: 'blur' },
                ],
            },
            form: {
                name: '',
                email: '',
                phone: '',
                address: '',
                birthday: '',
                gender: '',
                level: 0,
                avatar: '',
                password: '',
                rePassword: '',
            },
            state: {
                status: true,
            },
            level: {
                select: [
                    {
                        value: 0,
                        label: 'Member',
                    },
                    {
                        value: 1,
                        label: 'Admin',
                    },
                ],
            },
        }
    },
    props: {
        controller: { type: String, default: '' },
    },
    computed: {
        ...mapGetters({
            currItem: `${CONTROLLER}/getCurrItem`,
            user: 'auth/getUser',
        }),
        filterDistrict() {
            return Object.entries(this.District).filter(
                ([key, value]) => value.parent_code === this.address.city
            )
        },
        filterWard() {
            return Object.entries(this.Ward).filter(
                ([key, value]) => value.parent_code === this.address.district
            )
        },
    },
    watch: {
        currItem(val, oldVal) {
            if (val) {
                this.dialog.formVisible = true
                this.isEdit = true
                this.display.formTitle = 'Cập nhật'

                // Hiển thị thông tin item
                Object.entries(val).forEach(([key, value]) => {
                    if (value) {
                        if (
                            [
                                'name',
                                'email',
                                'phone',
                                'address',
                                'birthday',
                                'gender',
                                'level',
                                'avatar',
                            ].includes(key)
                        )
                            this.form[key] = value
                        if (['city', 'district', 'ward'].includes(key))
                            this.address[key] = value
                    }
                    if (['status', 'is_hot', 'is_bestseller'].includes(key)) {
                        value === 1
                            ? (this.state[key] = true)
                            : (this.state[key] = false)
                    }
                })
            }
        },
    },
    methods: {
        ...mapActions(CONTROLLER, ['createItem', 'updateItem']),
        /**
         * Reset tất cả trạng thái
         */
        handleReset(formName) {
            this.$store.commit(`${CONTROLLER}/setCurrItem`, null)
            this.handleResetForm()
            this.$refs[formName].clearValidate()
            this.isEdit = false
            this.dialog.formVisible = false
        },
        /**
         * Reset form
         */
        handleResetForm() {
            Object.keys(this.form).forEach(field => (this.form[field] = ''))
            Object.keys(this.address).forEach(
                field => (this.address[field] = '')
            )
            this.form.level = 0
            this.state.status = true
        },
        /**
         * Submit form
         */
        handleSubmit(formName) {
            this.$refs[formName].validate(valid => {
                if (valid) {
                    let data = new FormData()
                    Object.entries(this.form).forEach(([key, value]) =>
                        data.append(key, value)
                    )
                    Object.entries(this.state).forEach(([key, value]) => {
                        data.append(key, value ? 1 : 0)
                    })
                    Object.entries(this.address).forEach(([key, value]) =>
                        data.append(key, value)
                    )
                    if (!this.isEdit) {
                        this.$store
                            .dispatch('auth/register', data)
                            .then(res => {
                                if (res.flag) {
                                    this.$fire(
                                        foo.NOTIFICATION.success.registed
                                    )
                                } else {
                                    let errors = res.msg.response.data.errors
                                    this._showErrors(errors)
                                }
                            })
                    } else {
                        data.append('id', this.currItem.id)
                        data.append('field', 'update-item')
                        this.updateItem(data).then(res => {
                            if (res.flag) {
                                this.$fire(foo.NOTIFICATION.success.updated)
                            } else {
                                let errors = res.msg.response.data.errors
                                this._showErrors(errors)
                            }
                        })
                    }
                    this.handleReset(formName)
                }
            })
        },
    },
}
</script>
<style></style>
