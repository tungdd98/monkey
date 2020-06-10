<template>
    <div class="v-products">
        <el-row>
            <el-col :span="12">
                <filters :controller="controller"></filters>
            </el-col>
            <el-col :span="12">
                <edit :controller="controller"></edit>
            </el-col>
        </el-row>
        <div class="v-products-table">
            <el-table v-loading="isLoading" :data="items" v-if="items">
                <el-table-column
                    type="index"
                    width="50"
                    align="center"
                ></el-table-column>
                <el-table-column type="selection" width="55"></el-table-column>
                <el-table-column label="Tên tài khoản">
                    <template slot-scope="scope">
                        <div class="v-h2">{{ _notag(scope.row.name) }}</div>
                    </template>
                </el-table-column>
                <el-table-column label="Email">
                    <template slot-scope="scope">
                        <div>{{ scope.row.email }}</div>
                    </template>
                </el-table-column>
                <el-table-column label="Level">
                    <template slot-scope="scope">
                        <div>
                            {{ scope.row.level === 0 ? 'Member' : 'Admin' }}
                        </div>
                    </template>
                </el-table-column>
                <el-table-column label="Số điện thoại">
                    <template slot-scope="scope">
                        <div>{{ scope.row.phone }}</div>
                    </template>
                </el-table-column>
                <el-table-column label="Ngày tạo">
                    <template slot-scope="scope">
                        <div>
                            {{ _dateFormat(scope.row.created_at, 'short') }}
                        </div>
                    </template>
                </el-table-column>
                <el-table-column
                    fixed="right"
                    label="Thao tác"
                    align="center"
                    width="200"
                >
                    <template slot-scope="scope">
                        <el-button
                            type="primary"
                            icon="el-icon-edit"
                            size="small"
                            title="Edit"
                            circle
                            @click="handleShow(scope.row)"
                        ></el-button>
                        <el-button
                            type="danger"
                            icon="el-icon-delete"
                            size="small"
                            title="Delete"
                            circle
                            @click="handleDelete(scope.row)"
                        ></el-button>
                        <el-button
                            type="warning "
                            icon="el-icon-key"
                            size="small"
                            title="Change Password"
                            circle
                            @click="handleChangePassword(scope.row)"
                        ></el-button>
                    </template>
                </el-table-column>
            </el-table>
            <pagination :total="total" :controller="controller"></pagination>
        </div>
    </div>
</template>
<script>
import Edit from './Edit'
import Filters from '../../components/Filters'
import Pagination from '../../components/Pagination'
import { mapGetters, mapActions, mapState } from 'vuex'
import foo from '@/configs'

const CONTROLLER = 'user'

export default {
    data() {
        return {
            controller: CONTROLLER,
        }
    },
    computed: {
        ...mapState({
            isLoading: state => state.isLoading,
        }),
        ...mapGetters({
            items: `${CONTROLLER}/getAll`,
            total: `${CONTROLLER}/getTotalList`,
            filters: `${CONTROLLER}/getFilter`,
        }),
    },
    created() {
        this.init()
    },
    methods: {
        ...mapActions(CONTROLLER, ['getList', 'deleteItem', 'getItemById']),
        /**
         * Khởi tạo dữ liệu
         */
        init() {
            this.getList({})
        },
        /**
         * Xoá bản ghi
         */
        handleDelete(data) {
            this.$fire(foo.NOTIFICATION.confirm.deleted).then(res => {
                if (res.value) {
                    this.deleteItem(data).then(res => {
                        if (res.flag) {
                            this.$store.dispatch(`${CONTROLLER}/getList`, {
                                per_page: this.filters.per_page,
                                order_by: this.filters.order_by,
                                order_dir: this.filters.order_dir,
                            })
                            this.$fire(foo.NOTIFICATION.success.deleted)
                        } else this.$fire(foo.NOTIFICATION.error)
                    })
                }
            })
        },
        /**
         * Hiển thị sản phẩm
         */
        handleShow(data) {
            this.getItemById(data.id).then(res => {
                if (!res.flag) {
                    this.$fire(foo.NOTIFICATION.error)
                }
            })
        },
        /**
         * Đổi password
         */
        handleChangePassword(data) {
            alert('Đang xây dựng')
        },
        /**
         * Đổi địa chỉ
         */
        handleChangeAddress(data) {
            this.getAddressByUserId(data.id).then(res => {
                if (!res.flag) {
                    this.$fire(foo.NOTIFICATION.error)
                }
            })
        },
    },
    components: {
        Edit,
        Filters,
        Pagination,
    },
}
</script>
<style></style>
