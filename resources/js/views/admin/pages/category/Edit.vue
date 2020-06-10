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
                            <el-col :span="16">
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
                                <el-row :gutter="20">
                                    <el-col :span="12">
                                        <el-form-item
                                            label="Danh mục cha"
                                            :label-width="
                                                display.formLabelWidth
                                            "
                                            prop="parent_id"
                                        >
                                            <el-select
                                                v-model="form.parent_id"
                                                placeholder="--Chọn--"
                                                clearable
                                                v-if="selectCategory"
                                            >
                                                <el-option
                                                    v-for="item in selectCategory"
                                                    :key="item.id"
                                                    :value="item.id"
                                                    :label="item.title"
                                                ></el-option>
                                            </el-select>
                                        </el-form-item>
                                    </el-col>
                                    <el-col :span="12">
                                        <el-form-item
                                            label="Loại danh mục"
                                            :label-width="
                                                display.formLabelWidth
                                            "
                                            style="float: right"
                                        >
                                            <el-select
                                                v-model="form.type"
                                                placeholder="--Chọn--"
                                                clearable
                                                v-if="selectType"
                                            >
                                                <el-option
                                                    v-for="item in selectType"
                                                    :key="item.id"
                                                    :value="item.code"
                                                    :label="item.title"
                                                ></el-option>
                                            </el-select>
                                        </el-form-item>
                                    </el-col>
                                </el-row>
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
                            <el-col :span="8">
                                <el-form-item
                                    label="Hiển thị"
                                    :label-width="display.formLabelWidth"
                                >
                                    <el-switch
                                        v-model="state.status"
                                    ></el-switch>
                                </el-form-item>
                                <el-form-item
                                    label="Ảnh banner"
                                    :label-width="display.formLabelWidth"
                                    prop="thumbnail"
                                >
                                    <el-upload
                                        action="/"
                                        ref="upload"
                                        list-type="picture-card"
                                        :auto-upload="false"
                                        :on-preview="handlePictureCardPreview"
                                        :limit="1"
                                        :on-change="handleChangeUpload"
                                        :file-list="image.list"
                                        :on-remove="handleRemove"
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

const CONTROLLER = 'category'

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
                parent_id: '',
                description: '',
                content: '',
                type: '',
                thumbnail: '',
            },
            state: {
                status: true,
            },
            image: {
                list: [],
            },
            selectCategory: [],
            selectType: [],
        }
    },
    props: {
        controller: { type: String, default: '' },
    },
    computed: {
        ...mapGetters({
            currItem: `${CONTROLLER}/getCurrItem`,
            items: `${CONTROLLER}/getAll`,
            user: 'auth/getUser',
        }),
    },
    watch: {
        currItem(val, oldVal) {
            if (val) {
                this.dialog.formVisible = true
                this.isEdit = true
                this.display.formTitle = 'Cập nhật'

                Object.entries(val).forEach(([key, value]) => {
                    if (value) {
                        this.form[key] = value
                    }
                    if (['status', 'is_hot', 'is_bestseller'].includes(key)) {
                        value === 1
                            ? (this.state[key] = true)
                            : (this.state[key] = false)
                    }
                })
                // Hiển thị danh sách ảnh
                if (val.thumbnail) {
                    this._limitDisplayImage(true)
                    this.image.list.push({
                        name: val.thumbnail,
                        url: this._getThumbnail(this.controller, val.thumbnail),
                    })
                }
            }
        },
        'dialog.formVisible': function(val, oldVal) {
            if (val) {
                this.queue(this.items)
                if (this.currItem) {
                    this.selectCategory = this.selectCategory.filter(
                        (value, key) => value.id !== this.currItem.id
                    )
                }
            }
        },
    },
    created() {
        this.$store.dispatch('datatype/getList').then(res => {
            if (res.flag) {
                this.selectType = res.data.data
            }
        })
    },
    methods: {
        ...mapActions(CONTROLLER, ['getList', 'createItem', 'updateItem']),
        /**
         * Hiển thị dialog hình ảnh
         */
        handlePictureCardPreview(file) {
            this.dialog.imageUrl = file.url
            this.dialog.visible = true
        },
        /**
         * Upload hình ảnh (giới hạn 1 hình ảnh)
         */
        handleChangeUpload(file) {
            this.form.thumbnail = file.raw
            this._limitDisplayImage(true)
        },
        /**
         * Reset tất cả trạng thái
         */
        handleReset(formName) {
            this.$store.commit(`${CONTROLLER}/setCurrItem`, null)
            this.handleResetForm()
            this.$refs[formName].clearValidate()

            this.selectCategory = []

            this.$refs.upload.clearFiles()
            Object.keys(this.image).forEach(key => (this.image[key] = []))
            this._limitDisplayImage(false)

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
                    Object.entries(this.state).forEach(([key, value]) =>
                        data.append(key, value ? 1 : 0)
                    )
                    if (!this.isEdit) {
                        data.append('created_by', this.user.name)
                        this.createItem(data).then(res => {
                            if (res.flag) {
                                this.$fire(foo.NOTIFICATION.success.created)
                            } else {
                                let errors = res.msg.response.data.errors
                                this._showErrors(errors)
                            }
                        })
                    } else {
                        data.append('id', this.currItem.id)
                        data.append('updated_by', this.user.name)
                        if (this.image.list.length > 0) {
                            data.append(
                                'currThumbnail',
                                this.image.list[0].name
                            )
                        }
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
        /**
         * Giới hạn upload hình ảnh khi xoá bỏ hình ảnh
         */
        handleRemove(file) {
            this.form.thumbnail = ''
            this._limitDisplayImage(false)
        },
        /**
         * Reset form
         */
        handleResetForm() {
            Object.keys(this.form).forEach(key => {
                this.form[key] = ''
            })
            Object.keys(this.state).forEach(key => {
                if (['status'].includes(key)) {
                    this.state[key] = true
                } else {
                    this.state[key] = false
                }
            })
        },
        /**
         * Đệ quy lấy select category
         */
        queue(categories) {
            categories.forEach((value, key) => {
                this.selectCategory.push({
                    id: value.id,
                    title: value.title,
                })
                if (value.children) {
                    this.queue(value.children)
                }
            })
        },
    },
}
</script>
<style lang="scss"></style>
