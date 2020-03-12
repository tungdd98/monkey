<template>
  <div class="v-products-dialog">
    <div class="v-products-dialog__add">
      <el-button type="primary" @click="dialogFormVisible = true">
        Thêm mới
        <i class="el-icon-document-add"></i>
      </el-button>
      <div class="v-products-dialog__form">
        <el-dialog :title="formTitle" :visible.sync="dialogFormVisible" :show-close="true">
          <el-form :model="form" :rules="rules" :ref="controller">
            <el-row :gutter="20">
              <el-col :span="16">
                <el-form-item label="Tiêu đề" :label-width="formLabelWidth" prop="title">
                  <el-input v-model="form.title" autocomplete="off">
                    <i slot="suffix" class="el-input__icon el-icon-edit"></i>
                  </el-input>
                </el-form-item>
                <el-form-item label="Link" :label-width="formLabelWidth">
                  <el-input v-model="form.link" autocomplete="off">
                    <i slot="suffix" class="el-input__icon el-icon-edit"></i>
                  </el-input>
                </el-form-item>
                <el-form-item label="Mô tả" :label-width="formLabelWidth">
                  <ckeditor :editor="editor" v-model="form.description" :config="editorConfig"></ckeditor>
                </el-form-item>
                <el-form-item label="Nội dung" :label-width="formLabelWidth">
                  <ckeditor :editor="editor" v-model="form.content" :config="editorConfig"></ckeditor>
                </el-form-item>
              </el-col>
              <el-col :span="8">
                <el-form-item label="Trạng thái" :label-width="formLabelWidth">
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
        description: '',
        content: '',
        link: '',
        thumbnail: '',
        status: 1
      }
    }
  },
  props: {
    controller: { type: String, default: '' }
  },
  methods: {
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
      if(this.form.thumbnail) {
        document.querySelector('.el-upload.el-upload--picture-card').style = 'display: none'
      } else {
        document.querySelector('.el-upload.el-upload--picture-card').style = 'display: block'
      }
    },
    /**
     * Reset form
     */
    handleReset(formName) {
      this.dialogFormVisible = false
      this.$refs[formName].resetFields()
      this.$refs.upload.clearFiles()
      this.form.thumbnail = ''
    },
    /**
     * Submit form
     */
    handleSubmit(formName) {
      this.$refs[formName].validate(valid => {
        if(valid) {
          this.dialogFormVisible = false
          console.log(this.form)
          // this.handleReset(formName)
        }
      })
    }
  }
};
</script>
<style lang="scss">
.el-dialog__title, .el-form-item__label {
  font-weight: 600;
}
</style>