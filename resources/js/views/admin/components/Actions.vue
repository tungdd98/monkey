<template>
    <el-table-column fixed="right" label="Thao tác" align="center" width="120">
        <template>
            <el-button
                v-for="item in foo.ACTION[controller]"
                :key="item.title"
                :type="item.type"
                :icon="item.icon"
                :size="item.size"
                :title="item.title"
                @click="item.event"
                circle
            ></el-button>
        </template>
    </el-table-column>
</template>
<script>
import foo from '@/configs'
export default {
    data() {
        return {
            foo,
        }
    },
    props: {
        controller: { type: String, default: '' },
    },
    methods: {
        handleShow() {
            console.log('hihi')
        },
        handleDelete() {
            console.log('hí hí')
        },
    },
}
</script>
<style></style>
