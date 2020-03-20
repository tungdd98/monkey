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
                <el-form-item label="Danh mục cha" :label-width="display.formLabelWidth" prop="parent_id">
                  <el-select v-model="form.parent_id" placeholder="--Chọn--" clearable v-if="selectCategory">
                    <el-option
                      v-for="item in selectCategory"
                      :key="item.id"
                      :value="item.id"
                      :label="item.title"
                    ></el-option>
                  </el-select>
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
      isEdit: false,
      editor: {
        type: ClassicEditor,
        config: {}
      },
      dialog: {
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
        parent_id: '',
        description: '',
        content: '',
        status: 1,
      },
      selectCategory: [],
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
  },
  watch: {
    currItem(val, oldVal) {
      if(val) {
        this.dialog.formVisible = true
        this.isEdit = true
        this.display.formTitle = 'Cập nhật'

        Object.entries(val).forEach(([key, value]) => {
          if(value && ['title', 'description', 'content', 'parent_id', 'status'].includes(key)) {
            this.form[key] = value
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
     * Submit form
     */
    handleSubmit(formName) {
      this.$refs[formName].validate(valid => {
        if(valid) {
          let data = new FormData()
          Object.entries(this.form).forEach(([key, value]) => data.append(key, value))

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
            data.append('id',             this.currItem.id)
            data.append('updated_by',     this.user.name)
            data.append('field',          'update-item')
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
      ['title', 'description', 'content', 'parent_id'].forEach(field => {
        this.form[field] = ''
      })
      this.form.status = 1
    },
  }
};
</script>
<style lang="scss">

</style>