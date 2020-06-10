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
                        <el-row :gutter="15">
                            <el-col :span="15">
                                <el-form-item
                                    label="Tiêu đề"
                                    :label-width="display.formLabelWidth"
                                    prop="title"
                                >
                                    <el-input
                                        v-model="form.title"
                                        autocomplete="off"
                                    >
                                        <i
                                            slot="suffix"
                                            class="el-input__icon el-icon-edit"
                                        ></i>
                                    </el-input>
                                </el-form-item>
                                <el-form-item
                                    label="Danh mục"
                                    :label-width="display.formLabelWidth"
                                    prop="category"
                                >
                                    <el-select
                                        v-model="category.list"
                                        placeholder="--Chọn--"
                                        v-if="category.select"
                                        multiple
                                        collapse-tags
                                    >
                                        <el-option
                                            v-for="item in category.select"
                                            :key="item.id"
                                            :value="item.id"
                                            :label="item.title"
                                        ></el-option>
                                    </el-select>
                                </el-form-item>
                                <el-form-item
                                    label="Hình ảnh"
                                    :label-width="display.formLabelWidth"
                                >
                                    <el-upload
                                        action="/"
                                        ref="upload"
                                        list-type="picture-card"
                                        :auto-upload="false"
                                        :on-preview="handlePictureCardPreview"
                                        :on-change="handleChangeUpload"
                                        :on-remove="handleRemoveUpdate"
                                        :file-list="image.default"
                                    >
                                        <i class="el-icon-plus"></i>
                                    </el-upload>
                                    <el-dialog :visible.sync="dialog.visible">
                                        <img
                                            width="100%"
                                            :src="dialog.imageUrl"
                                            alt
                                        />
                                    </el-dialog>
                                </el-form-item>
                                <el-form-item
                                    label="Mô tả"
                                    :label-width="display.formLabelWidth"
                                    prop="description"
                                >
                                    <ckeditor
                                        :editor="editor.type"
                                        v-model="form.description"
                                        :config="editor.config"
                                    ></ckeditor>
                                </el-form-item>
                                <el-form-item
                                    label="Nội dung"
                                    :label-width="display.formLabelWidth"
                                    prop="content"
                                >
                                    <ckeditor
                                        :editor="editor.type"
                                        v-model="form.content"
                                        :config="editor.config"
                                    ></ckeditor>
                                </el-form-item>
                            </el-col>
                            <el-col :span="9">
                                <el-row :gutter="5">
                                    <el-col :span="8">
                                        <el-form-item
                                            label="Hiển thị"
                                            :label-width="
                                                display.formLabelWidth
                                            "
                                        >
                                            <el-switch
                                                v-model="state.status"
                                            ></el-switch>
                                        </el-form-item>
                                    </el-col>
                                    <el-col :span="8">
                                        <el-form-item
                                            label="Nổi bật"
                                            :label-width="
                                                display.formLabelWidth
                                            "
                                        >
                                            <el-switch
                                                v-model="state.is_hot"
                                            ></el-switch>
                                        </el-form-item>
                                    </el-col>
                                    <el-col :span="8">
                                        <el-form-item
                                            label="Khuyến mãi"
                                            :label-width="
                                                display.formLabelWidth
                                            "
                                        >
                                            <el-switch
                                                v-model="state.is_bestseller"
                                            ></el-switch>
                                        </el-form-item>
                                    </el-col>
                                </el-row>
                                <el-form-item
                                    label="Mã sản phẩm"
                                    :label-width="display.formLabelWidth"
                                    prop="code"
                                >
                                    <el-input
                                        v-model.number="form.code"
                                        autocomplete="off"
                                    >
                                        <i
                                            slot="suffix"
                                            class="el-input__icon el-icon-edit"
                                        ></i>
                                    </el-input>
                                </el-form-item>
                                <el-form-item
                                    label="Giá thị trường"
                                    :label-width="display.formLabelWidth"
                                >
                                    <el-input
                                        v-model.number="form.original_price"
                                        autocomplete="off"
                                    >
                                        <i
                                            slot="suffix"
                                            class="el-input__icon el-icon-edit"
                                        ></i>
                                    </el-input>
                                </el-form-item>
                                <el-form-item
                                    label="Giá bán lẻ"
                                    :label-width="display.formLabelWidth"
                                    prop="price"
                                >
                                    <el-input
                                        v-model.number="form.price"
                                        autocomplete="off"
                                    >
                                        <i
                                            slot="suffix"
                                            class="el-input__icon el-icon-edit"
                                        ></i>
                                    </el-input>
                                </el-form-item>
                                <el-form-item
                                    label="Số lượng"
                                    :label-width="display.formLabelWidth"
                                >
                                    <el-input
                                        v-model.number="form.quantity"
                                        autocomplete="off"
                                    >
                                        <i
                                            slot="suffix"
                                            class="el-input__icon el-icon-edit"
                                        ></i>
                                    </el-input>
                                </el-form-item>
                                <el-form-item
                                    label="Đơn vị tính"
                                    :label-width="display.formLabelWidth"
                                >
                                    <el-select
                                        v-model="form.unit_id"
                                        placeholder="--Chọn--"
                                        v-if="unit.select"
                                        collapse-tags
                                    >
                                        <el-option
                                            v-for="item in unit.select"
                                            :key="item.id"
                                            :value="item.id"
                                            :label="item.title"
                                        ></el-option>
                                    </el-select>
                                </el-form-item>
                                <el-form-item
                                    label="Nhà sản xuất"
                                    :label-width="display.formLabelWidth"
                                >
                                    <el-select
                                        v-model="form.supplier_id"
                                        placeholder="--Chọn--"
                                        v-if="supplier.select"
                                        collapse-tags
                                    >
                                        <el-option
                                            v-for="item in supplier.select"
                                            :key="item.id"
                                            :value="item.id"
                                            :label="item.title"
                                        ></el-option>
                                    </el-select>
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

const CONTROLLER = 'product'
const DATATYPE = 'Product'

export default {
    data() {
        return {
            isEdit: false,
            editor: {
                type: ClassicEditor,
                config: {},
            },
            dialog: {
                imageUrl: '',
                visible: false,
                formVisible: false,
            },
            display: {
                formTitle: 'Thêm mới',
                formLabelWidth: '120px',
            },
            rules: {
                title: foo.RULES.title,
            },
            form: {
                title: '',
                code: '',
                description: '',
                content: '',
                thumbnail: '',
                price: '',
                original_price: '',
                quantity: '',
                unit_id: '',
                supplier_id: '',
            },
            state: {
                status: true,
                is_hot: false,
                is_bestseller: false,
            },
            image: {
                list: [],
                default: [],
                remove: [],
            },
            category: {
                select: [],
                list: [],
                default: [],
            },
            unit: {
                select: [],
            },
            supplier: {
                select: [],
            },
        }
    },
    computed: {
        ...mapGetters({
            currItem: `${CONTROLLER}/getCurrItem`,
            user: 'auth/getUser',
        }),
    },
    props: {
        controller: { type: String, default: '' },
    },
    watch: {
        currItem(val, oldVal) {
            if (val) {
                this.dialog.formVisible = true
                this.isEdit = true
                this.display.formTitle = 'Cập nhật'

                // Hiển thị thông tin item
                Object.entries(val).forEach(([key, value]) => {
                    if (value && key !== 'images') this.form[key] = value
                    if (['status', 'is_hot', 'is_bestseller'].includes(key))
                        value === 1
                            ? (this.state[key] = true)
                            : (this.state[key] = false)
                })
                // Hiển thị danh sách ảnh
                JSON.parse(val.images).forEach(image => {
                    this.image.default.push({
                        name: image,
                        url: this._getThumbnail(this.controller, image),
                    })
                })
            }
        },
        'dialog.formVisible': function(val, oldVal) {
            if (val) {
                if (!this.isEdit) {
                    this.category.list = []
                } else {
                    ;['category', 'unit', 'supplier'].forEach(value => {
                        this.getPropertyById({
                            id: this.currItem.id,
                            property: value,
                        }).then(res => {
                            if (res.flag) {
                                if (['category'].includes(value)) {
                                    res.data.forEach(item =>
                                        this[value].list.push(
                                            item.pivot[`${value}_id`]
                                        )
                                    )
                                    this[value].default = this[value].list
                                } else {
                                    res.data.forEach(
                                        item =>
                                            (this.form[`${value}_id`] = item.id)
                                    )
                                }
                            }
                        })
                    })
                }
            }
        },
    },
    created() {
        // Lấy danh sách category
        this.$store.dispatch('category/getList', {}).then(res => {
            if (res.flag) {
                this.category.select = res.data.filter(
                    (value, key) => value.type === DATATYPE
                )
            }
        })
        // Lấy danh sách đơn vị tính
        this.$store
            .dispatch('unit/getList', {
                pagination: false,
            })
            .then(res => {
                if (res.flag) this.unit.select = res.data.data
            })
        // Lấy danh sách nhà sản xuất
        this.$store
            .dispatch('supplier/getList', {
                pagination: false,
            })
            .then(res => {
                if (res.flag) this.supplier.select = res.data.data
            })
    },
    methods: {
        ...mapActions(CONTROLLER, [
            'createItem',
            'updateItem',
            'getPropertyById',
        ]),
        /**
         * Hiển thị dialog hình ảnh
         */
        handlePictureCardPreview(file) {
            this.dialog.imageUrl = file.url
            this.dialog.visible = true
        },
        /**
         * Upload hình ảnh
         */
        handleChangeUpload(file) {
            this.image.list.push(file.raw)
        },
        /**
         * Reset tất cả trạng thái
         */
        handleReset(formName) {
            this.$store.commit(`${CONTROLLER}/setCurrItem`, null)
            this.handleResetForm()
            this.$refs[formName].clearValidate()

            this.$refs.upload.clearFiles()
            Object.keys(this.image).forEach(key => (this.image[key] = []))

            this.category.list = []
            this.category.default = []

            this.isEdit = false
            this.dialog.formVisible = false
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

                    if (!this.isEdit) {
                        this.image.list.forEach((value, key) =>
                            data.append(`images[${key}]`, value)
                        )
                        data.append('created_by', this.user.name)
                        this.category.list.forEach((value, key) =>
                            data.append(`categories[${key}]`, value)
                        )

                        this.createItem(data).then(res => {
                            if (res.flag)
                                this.$fire(foo.NOTIFICATION.success.created)
                            else {
                                let errors = res.msg.response.data.errors
                                this._showErrors(errors)
                            }
                        })
                    } else {
                        let categoriesUpdate = this._deduplicate(
                            this.category.list,
                            this.category.default
                        )
                        let categoriesRemove = this._deduplicate(
                            this.category.default,
                            this.category.list
                        )

                        data.append('id', this.currItem.id)
                        data.append('updated_by', this.user.name)
                        data.append('field', 'update-item')

                        this.image.remove.forEach((value, key) =>
                            data.append(`imagesRemove[${key}]`, value)
                        )

                        this.image.list.forEach((value, key) =>
                            data.append(`imagesUpdate[${key}]`, value)
                        )

                        this.image.default.forEach((value, key) =>
                            data.append(`images[${key}]`, value.name)
                        )

                        categoriesRemove.forEach((value, key) =>
                            data.append(`categoriesRemove[${key}]`, value)
                        )
                        categoriesUpdate.forEach((value, key) =>
                            data.append(`categoriesUpdate[${key}]`, value)
                        )

                        this.updateItem(data).then(res => {
                            if (res.flag)
                                this.$fire(foo.NOTIFICATION.success.updated)
                            else {
                                let errors = res.msg.response.data.errors
                                this._showErrors(errors)
                            }
                        })
                    }
                    this.handleReset(formName)
                }
            })
        },
        /**
         * Reset form
         */
        handleResetForm() {
            Object.keys(this.form).forEach(key => {
                this.form[key] = ''
            })
            Object.keys(this.state).forEach(key => {
                if (['status'].includes(key)) this.state[key] = true
                else this.state[key] = false
            })
        },
        /**
         * Xoá ảnh để update
         */
        handleRemoveUpdate(file) {
            if (this.isEdit) this.image.remove.push(file.name)
        },
    },
}
</script>
<style lang="scss"></style>
