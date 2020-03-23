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
								<el-form-item label="Tên tài khoản" :label-width="display.formLabelWidth" prop="name">
									<el-input v-model="form.name" autocomplete="off">
										<i slot="suffix" class="el-input__icon el-icon-edit"></i>
									</el-input>
								</el-form-item>
								<el-row :gutter="20">
									<el-col :span="12">
										<el-form-item label="Giới tính" :label-width="display.formLabelWidth" prop="gender">
											<el-select v-model="form.gender" placeholder="--Chọn--">
												<el-option value="1">Nam</el-option>
												<el-option value="0">Nữ</el-option>
											</el-select>
										</el-form-item>
									</el-col>
                  <el-col :span="12">
										<el-form-item label="Level" :label-width="display.formLabelWidth" prop="gender" style="float: right">
											<el-select v-model="form.level" placeholder="--Chọn--">
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
								<el-form-item label="Email" :label-width="display.formLabelWidth" prop="email">
									<el-input v-model="form.email" autocomplete="off">
										<i slot="suffix" class="el-input__icon el-icon-edit"></i>
									</el-input>
								</el-form-item>
                <el-form-item label="Mật khẩu" :label-width="display.formLabelWidth" prop="password" v-if="!isEdit">
									<el-input v-model="form.password" autocomplete="off" type="password">
										<i slot="suffix" class="el-input__icon el-icon-edit"></i>
									</el-input>
								</el-form-item>
								<el-form-item label="Số điện thoại" :label-width="display.formLabelWidth" prop="phone">
									<el-input v-model="form.phone" autocomplete="off">
										<i slot="suffix" class="el-input__icon el-icon-edit"></i>
									</el-input>
								</el-form-item>
								<el-form-item label="Địa chỉ" :label-width="display.formLabelWidth" prop="address">
									<el-input v-model="form.address" autocomplete="off">
										<i slot="suffix" class="el-input__icon el-icon-edit"></i>
									</el-input>
								</el-form-item>
							</el-col>
							<el-col :span="8">
								<el-form-item label="Hiển thị" :label-width="display.formLabelWidth">
									<el-switch v-model="state.status"></el-switch>
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
import foo from "@/configs";
import { mapActions, mapGetters } from "vuex";

const CONTROLLER = "user";
export default {
	data() {
		return {
			isEdit: false,
			dialog: {
				formVisible: false
			},
			display: {
				formTitle: "Thêm mới",
				formLabelWidth: "120px"
			},
			rules: {},
			form: {
				name: "",
				email: "",
				address: "",
				phone: "",
				birthday: "",
				gender: "",
				level: 0,
        avatar: "",
        password: ""
			},
			state: {
				status: true
			},
			level: {
				select: [
					{
						value: 0,
						label: 'Member'
					},
					{
						value: 1,
						label: 'Admin'
					}
				]
			}
		};
	},
	props: {
		controller: { type: String, default: "" }
	},
	computed: {
		...mapGetters({
			currItem: `${CONTROLLER}/getCurrItem`,
			user: "auth/getUser"
		})
  },
  watch: {
    currItem(val, oldVal) {
      if(val) {
        this.dialog.formVisible = true
        this.isEdit = true
        this.display.formTitle = 'Cập nhật'

        // Hiển thị thông tin item
        Object.entries(val).forEach(([key, value]) => {
          if(value) {
            this.form[key] = value
          }
          if(['status', 'is_hot', 'is_bestseller'].includes(key)) {
            value === 1 ? this.state[key] = true : this.state[key] = false
          }
        })
      }  
    },
  },
	methods: {
    ...mapActions(CONTROLLER, ["createItem", "updateItem"]),
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
      Object.keys(this.form).forEach(field => {
        this.form[field] = ''
			})
			this.form.level = 0
      this.state.status = true
    },
    /**
     * Submit form
     */
    handleSubmit(formName) {
      this.$refs[formName].validate(valid => {
        if(valid) {
          let data = new FormData()
          Object.entries(this.form).forEach(([key, value]) => data.append(key, value))
          Object.entries(this.state).forEach(([key, value]) => {
            let numberValue = value ? 1 : 0
            data.append(key, numberValue)
          })
          if(!this.isEdit) {
            this.$store.dispatch('auth/register', data).then(res => {
              if(res.flag) {
                this.$fire(foo.NOTIFICATION.success.registed)
              } else {
                let errors = res.msg.response.data.errors
                this._showErrors(errors)
              }
            })
          } else {
            data.append('id',             this.currItem.id)
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
	}
};
</script>
<style>
</style>