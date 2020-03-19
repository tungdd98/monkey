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
                  <el-select v-model="category.list" placeholder="--Chọn--" v-if="category.select" multiple collapse-tags>
                    <el-option
                      v-for="item in category.select"
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
                <el-form-item label="Giảm giá (%)" :label-width="display.formLabelWidth">
                  <el-input v-model.number="form.sale_up" autocomplete="off">
                    <i slot="suffix" class="el-input__icon el-icon-edit"></i>
                  </el-input>
                </el-form-item>
                <el-form-item label="Loại sản phẩm" :label-width="display.formLabelWidth">
                  <el-select v-model="type.list" placeholder="--Chọn--" v-if="type.select" multiple collapse-tags>
                    <el-option
                      v-for="item in type.select"
                      :key="item.id"
                      :value="item.id"
                      :label="item.title"
                    ></el-option>
                  </el-select>
                </el-form-item>
                <el-form-item label="Đơn vị tính" :label-width="display.formLabelWidth">
                  <el-select v-model="form.unit_id" placeholder="--Chọn--" v-if="type.select" collapse-tags>
                    <el-option
                      v-for="item in unit.select"
                      :key="item.id"
                      :value="item.id"
                      :label="item.title"
                    ></el-option>
                  </el-select>
                </el-form-item>
                <el-form-item label="Nhà sản xuất" :label-width="display.formLabelWidth">
                  <el-select v-model="form.supplier_id" placeholder="--Chọn--" v-if="supplier.select" collapse-tags>
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
      },
      form: {
        title: '',
        code: '',
        description: '',
        content: '',
        thumbnail: '',
        unit_id: '',
        supplier_id: '',
        price: 0,
        sale_up: 0,
        quantity: 1,
        status: 1,
      },
      imagesList: [],
      images: [],
      imagesRemove: [],
      category: {
        select: [],
        list: [],
        default: []
      },
      type: {
        select: [],
        list: [],
        default: []
      },
      unit: {
        select: [],
      },
      supplier: {
        select: [],
      }
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
          if(value && ['title', 'code', 'description', 'content', 'thumbnail', 'quantity', 'price', 'sale_up', 'status'].includes(key)) {
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
          this.category.list = []
          this.type.list     = []
        } else {
          ['category', 'type', 'unit', 'supplier'].forEach(value => {
            this.getPropertyById({ id: this.currItem.id, property: value }).then(res => {
              if(res.flag) {
                if(['category', 'type'].includes(value)) {
                  res.data.forEach(item => this[value].list.push(item.pivot[`${value}_id`]))
                  this[value].default = this[value].list
                } else {
                  res.data.forEach(item => this.form[`${value}_id`] = item.id)
                }
              }
            })
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
        this.category.select = res.data.data
      }
    })
    // Lấy danh sách loại sản phẩm
    this.$store.dispatch('type/getList', {
      pagination: false
    }).then(res => {
      if(res.flag) {
        this.type.select = res.data.data
      }
    })
    // Lấy danh sách đơn vị tính
    this.$store.dispatch('unit/getList', {
      pagination: false
    }).then(res => {
      if(res.flag) {
        this.unit.select = res.data.data
      }
    })
    // Lấy danh sách nhà sản xuất
    this.$store.dispatch('supplier/getList', {
      pagination: false
    }).then(res => {
      if(res.flag) {
        this.supplier.select = res.data.data
      }
    })
  },
  methods: {
    ...mapActions(CONTROLLER, ['createItem', 'updateItem', 'getPropertyById']),
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
      this.category.list = []
      this.category.default = []
      this.type.list = []
      this.type.default = []
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
            this.category.list.forEach((value, key) => data.append(`categories[${key}]`, value))
            this.type.list.forEach((value, key) => data.append(`types[${key}]`, value))
            this.createItem(data).then(res => {
              if(res.flag) {
                this.$fire(foo.NOTIFICATION.success.created)
              } else {
                let errors = res.msg.response.data.errors
                this._showErrors(errors)
              }
            })
          } else {
            let categoriesUpdate = this._deduplicate(this.category.list, this.category.default)
            let categoriesRemove = this._deduplicate(this.category.default, this.category.list)

            let typesUpdate = this._deduplicate(this.type.list, this.type.default)
            let typesRemove = this._deduplicate(this.type.default, this.type.list)

            data.append('id', this.currItem.id)
            data.append('updated_by', this.user.name)
            data.append('field', 'update-item')
            this.imagesRemove.forEach((value, key) => data.append(`imagesRemove[${key}]`, value))
            categoriesRemove.forEach((value, key) => data.append(`categoriesRemove[${key}]`, value))
            categoriesUpdate.forEach((value, key) => data.append(`categoriesUpdate[${key}]`, value))

            typesRemove.forEach((value, key) => data.append(`typesRemove[${key}]`, value))
            typesUpdate.forEach((value, key) => data.append(`typesUpdate[${key}]`, value))
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
      ['title', 'code', 'description', 'content', 'thumbnail'].forEach(field => {
        this.form[field] = ''
      })
      this.form.price           = 0
      this.form.sale_up         = 0
      this.form.quantity        = 1
      this.form.status          = 1
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