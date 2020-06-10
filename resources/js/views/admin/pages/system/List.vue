<template>
    <div>
        <h4 class="display-4" style="font-size: 20px; font-weight: 500">
            Quản lý hệ thống
        </h4>
        <div class="mt-5" style="padding: 10px; background: #fff">
            <div class="d-flex justify-content-end mb-2">
                <el-button type="success" size="small" @click="handleSubmit"
                    >Cập nhật</el-button
                >
            </div>
            <el-form :model="info" :rules="rules" ref="system">
                <el-form-item
                    label="Công ty"
                    :label-width="display.formLabelWidth"
                >
                    <el-input v-model="info.company" autocomplete="off">
                        <i
                            slot="suffix"
                            class="el-input__icon el-icon-edit"
                        ></i>
                    </el-input>
                </el-form-item>
                <el-form-item
                    label="Địa chỉ"
                    :label-width="display.formLabelWidth"
                >
                    <el-input
                        v-model="info.address"
                        autocomplete="off"
                        type="textarea"
                    >
                        <i
                            slot="suffix"
                            class="el-input__icon el-icon-edit"
                        ></i>
                    </el-input>
                </el-form-item>
                <el-form-item
                    label="Điện thoại"
                    :label-width="display.formLabelWidth"
                >
                    <el-input v-model="info.phone" autocomplete="off">
                        <i
                            slot="suffix"
                            class="el-input__icon el-icon-edit"
                        ></i>
                    </el-input>
                </el-form-item>
                <el-form-item
                    label="Hotline"
                    :label-width="display.formLabelWidth"
                >
                    <el-input v-model="info.hotline" autocomplete="off">
                        <i
                            slot="suffix"
                            class="el-input__icon el-icon-edit"
                        ></i>
                    </el-input>
                </el-form-item>
                <el-form-item
                    label="Giờ mở cửa"
                    :label-width="display.formLabelWidth"
                >
                    <el-input v-model="info.time" autocomplete="off">
                        <i
                            slot="suffix"
                            class="el-input__icon el-icon-edit"
                        ></i>
                    </el-input>
                </el-form-item>
                <el-form-item
                    label="Fanpage"
                    :label-width="display.formLabelWidth"
                >
                    <el-input v-model="info.fanpage" autocomplete="off">
                        <i
                            slot="suffix"
                            class="el-input__icon el-icon-edit"
                        ></i>
                    </el-input>
                </el-form-item>
                <el-form-item
                    label="Copyright"
                    :label-width="display.formLabelWidth"
                >
                    <el-input v-model="info.copyright" autocomplete="off">
                        <i
                            slot="suffix"
                            class="el-input__icon el-icon-edit"
                        ></i>
                    </el-input>
                </el-form-item>
                <el-form-item
                    label="Mô tả ngắn"
                    :label-width="display.formLabelWidth"
                >
                    <el-input v-model="info.brief" autocomplete="off">
                        <i
                            slot="suffix"
                            class="el-input__icon el-icon-edit"
                        ></i>
                    </el-input>
                </el-form-item>
                <el-form-item
                    label="Facebook"
                    :label-width="display.formLabelWidth"
                >
                    <el-input v-model="info.facebook" autocomplete="off">
                        <i
                            slot="suffix"
                            class="el-input__icon el-icon-edit"
                        ></i>
                    </el-input>
                </el-form-item>
                <el-form-item
                    label="Gmail"
                    :label-width="display.formLabelWidth"
                >
                    <el-input v-model="info.gmail" autocomplete="off">
                        <i
                            slot="suffix"
                            class="el-input__icon el-icon-edit"
                        ></i>
                    </el-input>
                </el-form-item>
                <el-form-item
                    label="Twitter"
                    :label-width="display.formLabelWidth"
                >
                    <el-input v-model="info.twitter" autocomplete="off">
                        <i
                            slot="suffix"
                            class="el-input__icon el-icon-edit"
                        ></i>
                    </el-input>
                </el-form-item>
                <el-form-item
                    label="Google"
                    :label-width="display.formLabelWidth"
                >
                    <el-input v-model="info.google" autocomplete="off">
                        <i
                            slot="suffix"
                            class="el-input__icon el-icon-edit"
                        ></i>
                    </el-input>
                </el-form-item>
            </el-form>
        </div>
    </div>
</template>

<script>
import axios from '@/plugins/axios'
import foo from '@/configs'
export default {
    data() {
        return {
            display: {
                formLabelWidth: '120px',
            },
            rules: {},
            info: {
                id: '',
                company: '',
                address: '',
                phone: '',
                hotline: '',
                time: '',
                copyright: '',
                fanpage: '',
                brief: '',
                facebook: '',
                gmail: '',
                twitter: '',
                google: '',
            },
        }
    },
    created() {
        this.init()
    },
    methods: {
        async init() {
            try {
                let result = await axios.get('system')
                if (result.status === 200) {
                    this.info = result.data.data[0]
                }
            } catch (error) {
                console.log(error)
            }
        },
        async handleSubmit() {
            try {
                let data = new FormData()
                Object.entries(this.info).forEach(([key, value]) =>
                    data.append(key, value)
                )
                let result = await axios.post('system', data)
                if (result.status === 200) {
                    this.$fire(foo.NOTIFICATION.success.updated)
                }
            } catch (error) {
                console.log(error)
                this.$fire(foo.NOTIFICATION.error)
            }
        },
    },
}
</script>

<style></style>
