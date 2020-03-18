<template>
  <div class="v-products-dialog">
    <div class="v-products-dialog__add">
      <el-button type="primary" @click="dialog.formVisible = true">
        Thêm mới
        <i class="el-icon-document-add"></i>
      </el-button>
      <div class="v-products-dialog__form">
        <el-dialog :title="display.formTitle" :visible.sync="dialog.formVisible" :show-close="false">
          <el-form :model="form" :rules="rules" :ref="controller">
            <el-row :gutter="20">
              <el-col :span="16">
                <el-form-item label="Tiêu đề" :label-width="display.formLabelWidth" prop="title">
                  <el-input v-model="form.title" autocomplete="off">
                    <i slot="suffix" class="el-input__icon el-icon-edit"></i>
                  </el-input>
                </el-form-item>
                <el-form-item label="Danh mục" :label-width="display.formLabelWidth" prop="category">
                  <el-select v-model="categories" placeholder="--Chọn--" v-if="selectCategory" multiple collapse-tags>
                    <el-option
                      v-for="item in selectCategory"
                      :key="item.id"
                      :value="item.id"
                      :label="item.title"
                    ></el-option>
                  </el-select>
                </el-form-item>
                <el-form-item label="Hình ảnh" :label-width="display.formLabelWidth">
                  <el-upload
                    action="/"
                    ref="upload"
                    list-type="picture-card"
                    :auto-upload="false"
                    :on-preview="handlePictureCardPreview"
                    :on-change="handleChangeUpload"
                    :on-remove="handleRemoveUpdate"
                    :file-list="imagesList"
                  >
                    <i class="el-icon-plus"></i>
                  </el-upload>
                  <el-dialog :visible.sync="dialog.visible">
                    <img width="100%" :src="dialog.imageUrl" alt />
                  </el-dialog>
                </el-form-item>
                <el-form-item label="Mô tả" :label-width="display.formLabelWidth" prop="description">
                  <ckeditor :editor="editor.type" v-model="form.description" :config="editor.config"></ckeditor>
                </el-form-item>
                <el-form-item label="Nội dung" :label-width="display.formLabelWidth" prop="content">
                  <ckeditor :editor="editor.type" v-model="form.content" :config="editor.config"></ckeditor>
                </el-form-item>
              </el-col>
              <el-col :span="8">
                <el-form-item label="Trạng thái" :label-width="display.formLabelWidth" prop="status">
                  <el-select v-model="form.status" placeholder="--Chọn--">
                    <el-option
                      v-for="item in selectStatus"
                      :key="item.title"
                      :value="item.value"
                      :label="item.title"
                    ></el-option>
                  </el-select>
                </el-form-item>
                <el-form-item label="Đơn giá" :label-width="display.formLabelWidth" prop="price">
                  <el-input v-model.number="form.price" autocomplete="off">
                    <i slot="suffix" class="el-input__icon el-icon-edit"></i>
                  </el-input>
                </el-form-item>
                <el-form-item label="Số lượng" :label-width="display.formLabelWidth">
                  <el-input v-model.number="form.quantity" autocomplete="off">
                    <i slot="suffix" class="el-input__icon el-icon-edit"></i>
                  </el-input>
                </el-form-item>
                <el-form-item label="Giảm giá" :label-width="display.formLabelWidth">
                  <el-input v-model.number="form.sale_up" autocomplete="off">
                    <i slot="suffix" class="el-input__icon el-icon-edit"></i>
                  </el-input>
                </el-form-item>
              </el-col>
            </el-row>
          </el-form>
          <span slot="footer" class="dialog-footer">
            <el-button size="small" @click="handleReset(controller)">Huỷ bỏ</el-button>
            <el-button type="success" size="small" @click="handleSubmit(controller)">Lưu lại</el-button>
          </span>
        </el-dialog>
      </div>
    </div>
  </div>
</template>
<script>
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
import foo from '@/configs'
import { mapActions, mapGetters } from 'vuex';

const CONTROLLER = 'product'

export default {
  data() {
    return {
      isEdit: false,
      editor: {
        type: ClassicEditor,
        config: {}
      },
      dialog: {
        imageUrl: '',
        visible: false,
        formVisible: false
      },
      display: {
        formTitle: 'Thêm mới',
        formLabelWidth: '120px'
      },
      selectStatus: foo.STATUS,
      rules: {
        title: foo.RULES.title,
        // category: foo.RULES.category
      },
      form: {
        title: '',
        description: '',
        content: '',
        thumbnail: '',
        quantity: 1,
        price: 0,
        sale_up: 0,
        is_hot: 0,
        is_bestseller: 0,
        status: 1,
      },
      fields: ['title', 'description', 'content', 'thumbnail'],
      imagesList: [],
      images: [],
      imagesRemove: [],
      selectCategory: [],
      categories: [],
      categoriesDefault: []
    }
  },
  computed: {
    ...mapGetters({
      currItem: `${CONTROLLER}/getCurrItem`,
      user: 'auth/getUser'
    }),
  },
  props: {
    controller: { type: String, default: '' }
  },
  watch: {
    currItem(val, oldVal) {
      if(val) {
        this.dialog.formVisible = true
        this.isEdit = true
        this.display.formTitle = 'Cập nhật'
        
        // Hiển thị thông tin item
        Object.entries(val).forEach(([key, value]) => {
          if(value && ['title', 'description', 'content', 'thumbnail', 'quantity', 'price', 'sale_up', 'is_hot', 'is_bestseller', 'status'].includes(key)) {
            this.form[key] = value
          }
        })
        // Hiển thị danh sách ảnh
        JSON.parse(val.images).forEach(image => {
          this.imagesList.push({
            name: image,
            url: this._getThumbnail(this.controller, image)
          })
        })
      }  
    },
    'dialog.formVisible': function(val, oldVal) {
      if(val) {
        if(!this.isEdit) {
          this.categories = []
        } else {
          this.getCategoryById(this.currItem.id).then(res => {
            if(res.flag) {
              res.data.forEach(item => this.categories.push(item.pivot.category_id))
              this.categoriesDefault = this.categories
            }
          })
        }
      }
    }
  },
  created() {
    // Lấy danh sách category
    this.$store.dispatch('category/getList', {
      pagination: false
    }).then(res => {
      if(res.flag) {
        this.selectCategory = res.data.data
      }
    })
  },
  methods: {
    ...mapActions(CONTROLLER, ['createItem', 'updateItem', 'getCategoryById']),
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
      this.images.push(file.raw)
    },
    /**
     * Reset tất cả trạng thái
     */
    handleReset(formName) {
      this.$store.commit(`${CONTROLLER}/setCurrItem`, null)
      this.handleResetForm()
      this.$refs[formName].clearValidate()
      this.$refs.upload.clearFiles()
      this.images = []
      this.imagesList = []
      this.imagesRemove = []
      this.categories = []
      this.categoriesDefault = []
      this.isEdit = false
      this.dialog.formVisible = false
    },
    /**
     * Submit form
     */
    handleSubmit(formName) {
      this.$refs[formName].validate(valid => {
        if(valid) {
          let data = new FormData()
          Object.entries(this.form).forEach(([key, value]) => data.append(key, value))
          this.images.forEach((value, key) => data.append(`images[${key}]`, value))

          if(!this.isEdit) {
            data.append('created_by', this.user.name)
            this.categories.forEach((value, key) => data.append(`categories[${key}]`, value))
            this.createItem(data).then(res => {
              if(res.flag) {
                this.$fire(foo.NOTIFICATION.success.created)
              } else {
                let errors = res.msg.response.data.errors
                this._showErrors(errors)
              }
            })
          } else {
            let categoriesUpdate = this._deduplicate(this.categories, this.categoriesDefault)
            let categoriesRemove = this._deduplicate(this.categoriesDefault, this.categories)
            data.append('id', this.currItem.id)
            data.append('updated_by', this.user.name)
            data.append('field', 'update-item')
            this.imagesRemove.forEach((value, key) => data.append(`imagesRemove[${key}]`, value))
            categoriesRemove.forEach((value, key) => data.append(`categoriesRemove[${key}]`, value))
            categoriesUpdate.forEach((value, key) => data.append(`categoriesUpdate[${key}]`, value))
            this.updateItem(data).then(res => {
              if(res.flag) {
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
     * Reset form
     */
    handleResetForm() {
      ['title', 'description', 'content', 'thumbnail'].forEach(field => {
        this.form[field] = ''
      })
      this.form.status          = 1
      this.form.is_hot          = 0
      this.form.is_bestseller   = 0
      this.form.sale_up         = 0
      this.form.price           = 0
      this.form.quantity        = 1
    },
    /**
     * Xoá ảnh để update
     */
    handleRemoveUpdate(file) {
      if(this.isEdit) {
        this.imagesRemove.push(file.name)
      }
    },
  }
};
</script>
<style lang="scss">

</style>