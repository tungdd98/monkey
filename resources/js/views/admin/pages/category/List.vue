<template>
    <div class="v-products">
        <edit :controller="controller"></edit>
        <div class="v-products-table">
            <el-tree
                v-if="items"
                :data="items"
                :props="defaultProps"
                show-checkbox
                default-expand-all
                node-key="id"
                :expand-on-click-node="false"
                class="tree-category"
            >
                <div class="custom-tree-node" slot-scope="{ node, data }">
                    <div>{{ node.label }}</div>
                    <div>
                        <el-button
                            type="primary"
                            size="mini"
                            icon="el-icon-edit"
                            title="Edit"
                            circle
                            @click="() => handleShow(data)"
                        ></el-button>
                        <el-button
                            type="danger"
                            size="mini"
                            icon="el-icon-delete"
                            circle
                            title="Delete"
                            @click="() => handleDelete(data)"
                        ></el-button>
                    </div>
                </div>
            </el-tree>
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

const CONTROLLER = 'category'

export default {
    data() {
        return {
            controller: CONTROLLER,
            defaultProps: {
                children: 'children',
                label: 'title',
            },
        }
    },
    computed: {
        ...mapState({
            isLoading: state => state.isLoading,
        }),
        ...mapGetters({
            items: `${CONTROLLER}/getAll`,
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
            this.getList({ action: 'tree' })
        },
        /**
         * Xoá bản ghi
         */
        handleDelete(data) {
            this.$fire(foo.NOTIFICATION.confirm.deleted).then(res => {
                if (res.value) {
                    this.deleteItem(data).then(res => {
                        if (res.flag) {
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
            this.getItemById({ id: data.id }).then(res => {
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
<style lang="scss">
.v-products-table .tree-category {
    padding: 10px;
}
.el-tree-node__content {
    height: 35px !important;
}
.custom-tree-node {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
    padding: 5px;
    margin: 5px 0;
}
</style>
