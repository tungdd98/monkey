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
                                <el-form-item
                                    label="Danh mục"
                                    :label-width="display.formLabelWidth"
                                    prop="category"
                                >
                                    <el-select
                                        v-model="form.category_id"
                                        placeholder="--Chọn--"
                                        v-if="category.select"
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
                                    label="Trạng thái"
                                    :label-width="display.formLabelWidth"
                                    prop="status"
                                >
                                    <el-select
                                        v-model="form.status"
                                        placeholder="--Chọn--"
                                    >
                                        <el-option
                                            v-for="item in selectStatus"
                                            :key="item.title"
                                            :value="item.value"
                                            :label="item.title"
                                        ></el-option>
                                    </el-select>
                                </el-form-item>
                                <el-form-item
                                    label="Ảnh đại diện"
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
                                        :file-list="imagesList"
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
                                <el-form-item
                                    label="Tác giả"
                                    :label-width="display.formLabelWidth"
                                    prop="author"
                                >
                                    <el-input
                                        v-model="form.author"
                                        autocomplete="off"
                                    >
                                        <i
                                            slot="suffix"
                                            class="el-input__icon el-icon-edit"
                                        ></i>
                                    </el-input>
                                </el-form-item>
                                <el-form-item
                                    label="Bút danh"
                                    :label-width="display.formLabelWidth"
                                    prop="pseudonym"
                                >
                                    <el-input
                                        v-model="form.pseudonym"
                                        autocomplete="off"
                                    >
                                        <i
                                            slot="suffix"
                                            class="el-input__icon el-icon-edit"
                                        ></i>
                                    </el-input>
                                </el-form-item>
                                <el-form-item
                                    label="Nguồn"
                                    :label-width="display.formLabelWidth"
                                    prop="source"
                                >
                                    <el-input
                                        v-model="form.source"
                                        autocomplete="off"
                                    >
                                        <i
                                            slot="suffix"
                                            class="el-input__icon el-icon-edit"
                                        ></i>
                                    </el-input>
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

const CONTROLLER = 'article'
const DATATYPE = 'News'

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
                thumbnail: foo.RULES.thumbnail,
            },
            form: {
                title: '',
                description: '',
                content: '',
                thumbnail: '',
                author: '',
                pseudonym: '',
                source: '',
                status: 1,
                category_id: '',
            },
            selectStatus: foo.STATUS,
            imagesList: [],
            category: {
                select: [],
                list: [],
                default: [],
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
    },
    watch: {
        currItem(val, oldVal) {
            if (val) {
                this.dialog.formVisible = true
                this.isEdit = true
                this.display.formTitle = 'Cập nhật'

                // Hiển thị thông tin item
                Object.entries(val).forEach(([key, value]) => {
                    if (
                        value &&
                        [
                            'title',
                            'description',
                            'content',
                            'link',
                            'thumbnail',
                            'status',
                        ].includes(key)
                    ) {
                        this.form[key] = value
                    }
                })
                // Hiển thị danh sách ảnh
                this.imagesList.push({
                    name: val.thumbnail,
                    url: this._getThumbnail(this.controller, val.thumbnail),
                })
            }
        },
        'dialog.formVisible': function(val, oldVal) {
            if (val) {
                if (!this.isEdit) {
                    this.category.list = []
                } else {
                    ;['category'].forEach(value => {
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
    },
    methods: {
        ...mapActions(CONTROLLER, ['createItem', 'updateItem']),
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
            this.$refs.upload.clearFiles()
            this.imagesList = []
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
                    if (!this.isEdit) {
                        data.append('created_by', this.user.name)
                        this.category.list.forEach((value, key) =>
                            data.append(`categories[${key}]`, value)
                        )
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
                        data.append('currThumbnail', this.imagesList[0].name)
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
            ;['title', 'description', 'content', 'link', 'thumbnail'].forEach(
                field => {
                    this.form[field] = ''
                }
            )
            this.form.status = 1
        },
    },
}
</script>
<style lang="scss"></style>
