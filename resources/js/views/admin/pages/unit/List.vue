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
                <el-table-column width="50">
                    <template slot-scope="scope">
                        <status
                            :item="scope.row"
                            :controller="controller"
                        ></status>
                    </template>
                </el-table-column>
                <el-table-column label="Ký hiệu">
                    <template slot-scope="scope">
                        <div class="v-h2">{{ _notag(scope.row.title) }}</div>
                    </template>
                </el-table-column>
                <el-table-column label="Ghi chú">
                    <template slot-scope="scope">
                        <div>{{ _notag(scope.row.note) }}</div>
                    </template>
                </el-table-column>
                <el-table-column label="Ngày tạo">
                    <template slot-scope="scope">
                        <div>
                            {{ _dateFormat(scope.row.created_at, 'short') }}
                        </div>
                        <div class="v-italic">{{ scope.row.created_by }}</div>
                    </template>
                </el-table-column>
                <el-table-column label="Cập nhật lần cuối">
                    <template slot-scope="scope">
                        <div>
                            {{ _dateFormat(scope.row.updated_at, 'short') }}
                        </div>
                        <div class="v-italic">{{ scope.row.updated_by }}</div>
                    </template>
                </el-table-column>
                <el-table-column
                    fixed="right"
                    label="Thao tác"
                    align="center"
                    width="120"
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
import Status from '../../components/Status'
import { mapActions, mapState, mapGetters } from 'vuex'
import foo from '@/configs'

const CONTROLLER = 'unit'

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
    },
    components: {
        Edit,
        Filters,
        Pagination,
        Status,
    },
}
</script>
<style lang="scss"></style>
