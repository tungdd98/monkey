<template>
	<div class="page-information">
		<div class="title">
			<h2 style="font-weight: 600">THÔNG TIN ĐƠN HÀNG</h2>
		</div>
		<div class="page">
			<el-row :gutter="20">
				<el-col :span="16">
					<el-form :model="form" :rules="rules" class="mt-5">
						<el-form-item label="Họ và tên" :label-width="display.formLabelWidth" prop="name">
							<el-input v-model="form.name" autocomplete="off">
								<i slot="suffix" class="el-input__icon el-icon-edit"></i>
							</el-input>
						</el-form-item>
						<el-form-item label="Giới tính" :label-width="display.formLabelWidth" prop="gender">
							<el-select v-model="form.gender" placeholder="--Chọn--">
								<el-option value="1">Nam</el-option>
								<el-option value="0">Nữ</el-option>
							</el-select>
						</el-form-item>
						<el-form-item label="Email" :label-width="display.formLabelWidth" prop="email">
							<el-input v-model="form.email" autocomplete="off">
								<i slot="suffix" class="el-input__icon el-icon-edit"></i>
							</el-input>
						</el-form-item>
						<el-form-item label="Số điện thoại" :label-width="display.formLabelWidth" prop="phone">
							<el-input v-model="form.phone" autocomplete="off">
								<i slot="suffix" class="el-input__icon el-icon-edit"></i>
							</el-input>
						</el-form-item>
						<el-form-item label="Địa chỉ" :label-width="display.formLabelWidth" prop="address">
							<el-input v-model="form.address" autocomplete="off" type="textarea">
								<i slot="suffix" class="el-input__icon el-icon-edit"></i>
							</el-input>
						</el-form-item>
					</el-form>
				</el-col>
				<el-col :span="8">
					<div class="Yorder">
						<table class="table">
							<tr>
								<th colspan="2">Giỏ hàng của bạn</th>
							</tr>
							<tr v-for="item in cart.all" :key="item.product.id">
								<td>{{ _notag(item.product.title) }} x {{ item.quantity }}</td>
								<td>{{ _formatCurrency(totalMoneyItem(item)) }}</td>
							</tr>
							<tr>
								<td>Tạm tính</td>
								<td class="text-right">{{ cart.totalMoney > 0 ? _formatCurrency(cart.totalMoney) : 0 }}</td>
							</tr>
							<tr>
								<td>Phí ship</td>
								<td class="text-right">0đ</td>
							</tr>
						</table>
            <router-link :to="{ name: 'checkout' }" tag="button" @click="handleSaveInformation">Tiếp tục</router-link>
					</div>
				</el-col>
			</el-row>
		</div>
	</div>
</template>
<script>
import { mapGetters } from "vuex";

export default {
	data() {
		return {
			form: {
				name: "",
				email: "",
				phone: "",
				address: "",
				birthday: "",
				gender: ""
			},
			rules: {},
			display: {
				formLabelWidth: "120px"
			}
		};
  },
  computed: {
		...mapGetters({
			cart: "cart/getCart"
		}),
  },
  methods: {
		totalMoneyItem(item) {
			return item.product.price * item.quantity
		},
  },
  methods: {
    handleSaveInformation() {
      alert('Đang cập nhật')
    }
  }
};
</script>
<style lang="scss" scoped>
.page-information {
	.page {
		background: #f6f6f6;
		border-radius: 0 0 5px 5px;
		padding: 25px;
	}
	form {
		flex: 4;
	}
	.Yorder {
		flex: 2;
	}
	.title {
		background: -webkit-gradient(
			linear,
			left top,
			right bottom,
			color-stop(0, #5195a8),
			color-stop(100, #70eaff)
		);
		background: -moz-linear-gradient(top left, #5195a8 0%, #70eaff 100%);
		background: -ms-linear-gradient(top left, #5195a8 0%, #70eaff 100%);
		background: -o-linear-gradient(top left, #5195a8 0%, #70eaff 100%);
		background: linear-gradient(to bottom right, #f75510 0%, #ffccb5 100%);
		border-radius: 5px 5px 0 0;
		padding: 20px;
		color: #f6f6f6;
	}
	h2 {
		margin: 0;
		padding-left: 15px;
	}
	.required {
		color: red;
	}

	label > span {
		float: left;
		width: 25%;
		margin-top: 12px;
		padding-right: 10px;
	}

	.Yorder {
		margin-top: 15px;
		min-height: 300px;
		padding: 10px;
		border: 1px solid #dadada;
	}

	p {
		display: block;
		color: #888;
		margin: 0;
		padding-left: 25px;
	}
	.Yorder > div {
		padding: 15px 0;
	}

	button {
		width: 100%;
		margin-top: 10px;
		padding: 10px;
		border: none;
		border-radius: 30px;
		background: #f75510;
		color: #fff;
		font-size: 15px;
		font-weight: bold;
		border: 1px solid #f75510;
		transition: 0.5s;
	}
	button:hover {
		cursor: pointer;
		background: #fff;
		color: #f75510;
	}
}
</style>