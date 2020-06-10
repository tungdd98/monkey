<template>
    <el-container class="full-height" id="v-admin">
        <v-aside></v-aside>
        <el-container class="v-body">
            <v-header></v-header>
            <el-main>
                <router-view></router-view>
            </el-main>
            <v-footer></v-footer>
        </el-container>
    </el-container>
</template>
<script>
import VAside from './templates/VAside'
import VHeader from './templates/VHeader'
import VFooter from './templates/VFooter'
export default {
    name: 'dashboard',
    components: {
        VAside,
        VHeader,
        VFooter,
    },
}
</script>
<style></style>
