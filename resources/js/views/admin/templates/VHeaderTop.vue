<template>
    <div class="v-header-top">
        <div class="v-header-brand">
            <h4 class="v-header-brand__title">Dashboard</h4>
        </div>
        <div class="v-header-account">
            <div class="v-header-account__icon">
                <el-badge :value="12">
                    <i class="el-icon-wallet"></i>
                </el-badge>
            </div>
            <div class="v-header-account__icon">
                <el-badge :value="3" type="primary">
                    <i class="el-icon-goods"></i>
                </el-badge>
            </div>
            <div class="v-header-account__icon">
                <el-badge :value="1" type="warning">
                    <i class="el-icon-folder"></i>
                </el-badge>
            </div>
            <el-dropdown trigger="click">
                <el-avatar
                    src="https://cube.elemecdn.com/0/88/03b0d39583f48206768a7534e55bcpng.png"
                ></el-avatar>
                <el-dropdown-menu slot="dropdown">
                    <el-dropdown-item v-if="user">
                        <span>{{ user.name }}</span>
                    </el-dropdown-item>
                    <el-dropdown-item icon="el-icon-circle-plus">
                        <span @click="handleLogout">Đăng xuất</span>
                    </el-dropdown-item>
                </el-dropdown-menu>
            </el-dropdown>
        </div>
    </div>
</template>
<script>
import { mapGetters, mapActions } from 'vuex'
export default {
    name: 'v-header-top',
    computed: {
        ...mapGetters({
            user: 'auth/getUser',
        }),
    },
    methods: {
        ...mapActions('auth', ['logout']),
        handleLogout() {
            this.logout().then(res => {
                if (res.flag) {
                    this.$router.push('/login')
                }
            })
        },
    },
}
</script>
<style lang=""></style>
