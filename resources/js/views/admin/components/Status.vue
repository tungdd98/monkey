<template>
    <div
        class="v-status"
        :title="item.status == 1 ? 'Hiển thị' : 'Ẩn'"
        :class="_showStatus(item.status)"
        @click="handleChangeStatus"
    ></div>
</template>
<script>
import foo from '@/configs'

export default {
    props: {
        item: { type: Object, default: null },
        controller: { type: String, default: '' },
    },
    computed: {
        filters() {
            return this.$store.getters[`${this.controller}/getFilter`]
        },
    },
    methods: {
        /**
         * Thay đổi trạng thái phần tử
         */
        handleChangeStatus() {
            this.$store
                .dispatch(`${this.controller}/changeStatus`, {
                    ...this.item,
                    field: 'status',
                })
                .then(res => {
                    if (res.flag) {
                        this.$store.dispatch(`${this.controller}/getList`, {
                            per_page: this.filters.per_page,
                            order_by: this.filters.order_by,
                            order_dir: this.filters.order_dir,
                            page: this.filters.page,
                        })
                        this.$fire(foo.NOTIFICATION.success.updated)
                    } else {
                        this.$fire(foo.NOTIFICATION.error)
                    }
                })
        },
    },
}
</script>
<style></style>
