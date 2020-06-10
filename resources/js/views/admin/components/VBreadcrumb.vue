<template>
    <el-breadcrumb separator="/" class="v-breadcrumb">
        <el-breadcrumb-item :to="{ path: '/' }">Dashboard</el-breadcrumb-item>
        <el-breadcrumb-item>{{ name }}</el-breadcrumb-item>
    </el-breadcrumb>
</template>
<script>
export default {
    name: 'v-breadcrumb',
    data() {
        return {
            name: this.$route.name,
        }
    },
    watch: {
        $route(val, oldVal) {
            this.name = val.name
        },
    },
}
</script>
<style lang=""></style>
