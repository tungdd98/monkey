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
        <div class="v-products-table mt-2">
            <el-table v-loading="isLoading" :data="items" v-if="items">
                <el-table-column
                    type="index"
                    width="50"
                    align="center"
                ></el-table-column>
                <el-table-column type="selection" width="55"></el-table-column>
                <el-table-column label="Mã đơn hàng">
                    <template slot-scope="scope">
                        <div class="v-h2">{{ 'KR' + scope.row.id }}</div>
                    </template>
                </el-table-column>
                <el-table-column label="Trạng thái">
                    <template slot-scope="scope">
                        <div class="v-h2" v-html="showStatus(scope.row)">
                            {{ showStatus(scope.row) }}
                        </div>
                    </template>
                </el-table-column>
                <el-table-column label="Tổng thanh toán">
                    <template slot-scope="scope">
                        <div>{{ _formatCurrency(scope.row.total) }}</div>
                    </template>
                </el-table-column>
                <el-table-column label="Tổng lượng mua" class="text-center">
                    <template slot-scope="scope">
                        <div>{{ scope.row.quantity }}</div>
                    </template>
                </el-table-column>
                <el-table-column label="Ngày tạo">
                    <template slot-scope="scope">
                        <div>
                            {{ _dateFormat(scope.row.created_at, 'short') }}
                        </div>
                    </template>
                </el-table-column>
                <el-table-column label="Cập nhật lần cuối">
                    <template slot-scope="scope">
                        <div>
                            {{ _dateFormat(scope.row.updated_at, 'short') }}
                        </div>
                    </template>
                </el-table-column>
                <el-table-column
                    fixed="right"
                    label="Thao tác"
                    align="center"
                    width="120"
                >
                    <template slot-scope="scope">
                        <el-dropdown>
                            <el-button
                                type="primary"
                                icon="el-icon-edit"
                                size="small"
                                title="Edit"
                                circle
                            ></el-button>
                            <el-dropdown-menu slot="dropdown">
                                <el-dropdown-item>
                                    <span
                                        @click="
                                            handleChangeStatus(scope.row, 0)
                                        "
                                        >Chưa giao hàng</span
                                    >
                                </el-dropdown-item>
                                <el-dropdown-item>
                                    <span
                                        @click="
                                            handleChangeStatus(scope.row, 1)
                                        "
                                        >Đang giao hàng</span
                                    >
                                </el-dropdown-item>
                                <el-dropdown-item>
                                    <span
                                        @click="
                                            handleChangeStatus(scope.row, 2)
                                        "
                                        >Hoàn tất</span
                                    >
                                </el-dropdown-item>
                                <el-dropdown-item>
                                    <span
                                        @click="
                                            handleChangeStatus(scope.row, 3)
                                        "
                                        >Huỷ đơn hàng</span
                                    >
                                </el-dropdown-item>
                            </el-dropdown-menu>
                        </el-dropdown>
                        <el-button
                            type="success"
                            icon="el-icon-view"
                            size="small"
                            title="View"
                            circle
                            @click="handleShow(scope.row)"
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
import { mapActions, mapState, mapGetters } from 'vuex'
import foo from '@/configs'

const CONTROLLER = 'order'

export default {
    data() {
        return {
            controller: CONTROLLER,
            foo,
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
        ...mapActions(CONTROLLER, ['getList', 'getItemById', 'changeStatus']),
        /**
         * Khởi tạo dữ liệu
         */
        init() {
            this.getList({})
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
         * Hiển thị trạng thái giao hàng
         */
        showStatus(item) {
            return `<span style="color: ${foo.ORDER[item.status].color}">${
                foo.ORDER[item.status].label
            }</span>`
        },
        /**
         * Thay đổi trạng thái đơn hàng
         */
        handleChangeStatus(item, status) {
            const data = {
                id: item.id,
                status,
            }
            this.changeStatus(data).then(res => {
                if (res.flag) {
                    this.$fire(foo.NOTIFICATION.success.updated)
                } else {
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
