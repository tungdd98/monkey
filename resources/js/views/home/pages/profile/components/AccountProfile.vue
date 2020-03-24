<template>
	<div class="ct-account">
		<h3 class="title-acc">thông tin cá nhân</h3>
		<el-form :model="form" :rules="rules" ref="form">
      <el-form-item label="Email" :label-width="display.formLabelWidth" prop="email">
				<el-input v-model="form.email" autocomplete="off" :disabled="true">
					<i slot="suffix" class="el-input__icon el-icon-edit"></i>
				</el-input>
			</el-form-item>
			<el-form-item label="Tên tài khoản" :label-width="display.formLabelWidth" prop="name">
				<el-input v-model="form.name" autocomplete="off">
					<i slot="suffix" class="el-input__icon el-icon-edit"></i>
				</el-input>
			</el-form-item>
			<el-row :gutter="20">
				<el-col :span="12">
					<el-form-item label="Giới tính" :label-width="display.formLabelWidth" prop="gender">
						<el-select v-model="form.gender" placeholder="--Chọn--">
							<el-option value="1" label="Nam"></el-option>
							<el-option value="0" label="Nữ"></el-option>
						</el-select>
					</el-form-item>
				</el-col>
				<el-col :span="12">
					<el-form-item label="Ngày sinh" :label-width="display.formLabelWidth" prop="birthday">
						<el-date-picker v-model="form.birthday" type="date" placeholder="--Chọn--"></el-date-picker>
					</el-form-item>
				</el-col>
			</el-row>
			<el-form-item label="Số điện thoại" :label-width="display.formLabelWidth" prop="phone">
				<el-input v-model="form.phone" autocomplete="off">
					<i slot="suffix" class="el-input__icon el-icon-edit"></i>
				</el-input>
			</el-form-item>
			<el-row :gutter="10">
				<el-col :span="8">
					<el-form-item label="Tỉnh/ Thành" :label-width="display.formLabelWidth">
						<el-select v-model="address.city" placeholder="--Chọn--" filterable>
							<el-option v-for="item in City" :key="item.code" :label="item.name" :value="item.code"></el-option>
						</el-select>
					</el-form-item>
				</el-col>
				<el-col :span="8">
					<el-form-item label="Quận/ Huyện" :label-width="display.formLabelWidth">
						<el-select v-model="address.district" placeholder="--Chọn--" filterable>
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
					<el-form-item label="Xã/ Phường" :label-width="display.formLabelWidth">
						<el-select v-model="address.ward" placeholder="--Chọn--" filterable>
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
			<el-form-item label="Địa chỉ" :label-width="display.formLabelWidth" prop="address">
				<el-input v-model="form.address" autocomplete="off" type="textarea">
					<i slot="suffix" class="el-input__icon el-icon-edit"></i>
				</el-input>
			</el-form-item>
		</el-form>
	</div>
</template>
<script>
import { mapGetters } from "vuex";
import * as District from "@/location/quan_huyen.json";
import * as City from "@/location/tinh_tp.json";
import * as Ward from "@/location/xa_phuong.json";
import foo from "@/configs";

export default {
	data() {
		return {
			City: City.default,
			District: District.default,
			Ward: Ward.default,
			display: {
				formTitle: "Thêm mới",
				formLabelWidth: "120px"
			},
			rules: {
			},
			form: {
				name: "",
				email: "",
				phone: "",
				address: "",
				birthday: "",
				gender: "",
				level: 0,
				avatar: "",
				password: "",
				rePassword: ""
			},
			address: {
				city: "",
				district: "",
				ward: ""
			}
		};
	},
	computed: {
		...mapGetters({
			user: "auth/getUser"
		}),
		filterDistrict() {
			return Object.entries(this.District).filter(
				([key, value]) => value.parent_code === this.address.city
			);
		},
		filterWard() {
			return Object.entries(this.Ward).filter(
				([key, value]) => value.parent_code === this.address.district
			);
		}
  },
  watch: {
    user (val, oldVal) {
      if(val) {
        Object.entries(val).forEach(([key, value]) => {
          if(value) {
						if(['name', 'email', 'phone', 'address', 'birthday', 'gender'].includes(key))
							this.form[key] = value
						if(['city', 'district', 'ward'].includes(key))
							this.address[key] = value
          }
        })
      }
    }
  }
};
</script>
<style>
</style>