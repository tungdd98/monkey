<template>
  <div class="v-products-dialog">
    <div class="v-products-dialog__add">
      <el-button type="primary" @click="dialogFormVisible = true">
        Thêm mới
        <i class="el-icon-document-add"></i>
      </el-button>
      <div class="v-products-dialog__form">
        <el-dialog :title="formTitle" :visible.sync="dialogFormVisible" :show-close="false">
          <el-form :model="form" :rules="rules" :ref="controller">
            <el-row :gutter="20">
              <el-col :span="16">
                <el-form-item label="Tiêu đề" :label-width="formLabelWidth" prop="title">
                  <el-input v-model="form.title" autocomplete="off">
                    <i slot="suffix" class="el-input__icon el-icon-edit"></i>
                  </el-input>
                </el-form-item>
                <el-form-item label="Danh mục cha" :label-width="formLabelWidth" prop="parent_id">
                  <el-select v-model="form.parent_id" placeholder="--Chọn--" clearable v-if="selectList">
                    <el-option
                      v-for="item in filterSelectList"
                      :key="item.id"
                      :value="item.id"
                      :label="item.title"
                    ></el-option>
                  </el-select>
                </el-form-item>
                <el-form-item label="Mô tả" :label-width="formLabelWidth" prop="description">
                  <ckeditor :editor="editor" v-model="form.description" :config="editorConfig"></ckeditor>
                </el-form-item>
                <el-form-item label="Nội dung" :label-width="formLabelWidth" prop="content">
                  <ckeditor :editor="editor" v-model="form.content" :config="editorConfig"></ckeditor>
                </el-form-item>
              </el-col>
              <el-col :span="8">
                <el-form-item label="Trạng thái" :label-width="formLabelWidth" prop="status">
                  <el-select v-model="form.status" placeholder="--Chọn--">
                    <el-option
                      v-for="item in selectStatus"
                      :key="item.title"
                      :value="item.value"
                      :label="item.title"
                    ></el-option>
                  </el-select>
                </el-form-item>
                <el-form-item label="Hình ảnh" :label-width="formLabelWidth" prop="thumbnail">
                  <el-upload
                    action="/"
                    ref="upload"
                    list-type="picture-card"
                    :auto-upload="false"
                    :on-preview="handlePictureCardPreview"
                    :limit="1"
                    :on-change="handleChangeUpload"
                    :file-list="imagesList"
                    :on-remove="handleRomove"
                  >
                    <i class="el-icon-plus"></i>
                  </el-upload>
                  <el-dialog :visible.sync="dialogVisible">
                    <img width="100%" :src="dialogImageUrl" alt />
                  </el-dialog>
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

const CONTROLLER = 'category'

export default {
  data() {
    return {
      editor: ClassicEditor,
      editorConfig: {},
      dialogImageUrl: "",
      dialogVisible: false,
      formTitle: 'Thêm mới',
      formLabelWidth: '120px',
      dialogFormVisible: false,
      selectStatus: foo.STATUS,
      rules: {
        title: foo.RULES.title,
        thumbnail: foo.RULES.thumbnail
      },
      form: {
        title: '',
        parent_id: '',
        description: '',
        content: '',
        status: 1,
        thumbnail: '',
      },
      imagesList: [],
      selectList: [],
      isEdit: false
    }
  },
  props: {
    controller: { type: String, default: '' }
  },
  computed: {
    ...mapGetters({
      currItem: `${CONTROLLER}/getCurrItem`,
      user: 'auth/getUser'
    }),
    filterSelectList() {
      return this.selectList.filter(item => item.id !== this.currItem.id)
    }
  },
  watch: {
    currItem(newItem, oldItem) {
      if(newItem) {
        this.dialogFormVisible = true
        this.isEdit = true
        this.formTitle = 'Cập nhật'

        for(let i in newItem) {
          const item = newItem[i]
          if(['title', 'description', 'content', 'status', 'thumbnail', 'parent_id'].includes(i)) {
            this.form[i] = item
          }
        }
        this.imagesList.push({
          name: newItem.thumbnail,
          url: this._getThumbnail(this.controller, newItem.thumbnail)
        })
        this.getMultiCategory().then(res => {
          if(res.flag) {
            this.selectList = res.data
          }
        })
      }  
    },
  },
  methods: {
    ...mapActions(CONTROLLER, ['createItem', 'updateItem', 'getMultiCategory']),
    /**
     * Hiển thị dialog hình ảnh
     */
    handlePictureCardPreview(file) {
      this.dialogImageUrl = file.url
      this.dialogVisible = true
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
      this.selectList = []
      this.dialogFormVisible = false
    },
    /**
     * Submit form
     */
    handleSubmit(formName) {
      this.$refs[formName].validate(valid => {
        if(valid) {
          let data = new FormData()
          for(let i in this.form) {
            const field = this.form[i]
            data.append(i, field)
          }
          if(!this.isEdit) {
            data.append('created_by', this.user.name)
            this.createItem(data).then(res => {
              if(res.flag) {
                this.$fire(foo.NOTIFICATION.success.created)
              } else {
                let errors = res.msg.response.data.errors
                this._showErrors(errors)
              }
            })
          } else {
            data.append('updated_by', this.user.name)
            data.append('id', this.currItem.id)
            data.append('field', 'update-item')
            data.append('currThumbnail', this.imagesList[0].name)
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
     * Khi xoá bỏ hình ảnh
     */
    handleRomove(file) {
      this.form.thumbnail = ''
      this._limitDisplayImage(false)
    },
    /**
     * Reset form
     */
    handleResetForm() {
      ['title', 'description', 'content', 'parent_id', 'thumbnail'].forEach(field => {
        this.form[field] = ''
      })
      this.form.status = 1
    },
  }
};
</script>
<style lang="scss">

</style>