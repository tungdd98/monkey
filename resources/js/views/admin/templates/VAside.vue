<template>
    <el-aside width="260px" class="v-aside">
        <div class="v-aside-brand">
            <router-link to="/">
                <img
                    width="118"
                    height="46"
                    src="https://coreui.io/vue/demo/3.0-beta.1/img/brand/coreui-signet-white.svg"
                    alt
                />
                <div class="v-aside-brand__text">CMS Foo.space</div>
            </router-link>
        </div>
        <el-menu
            default-active="1"
            class="v-menu-aside"
            background-color="transparent"
            text-color="#fff"
            active-text-color="#409EFF"
        >
            <el-menu-item index="1">
                <template slot="title">
                    <i class="el-icon-menu"></i>
                    <router-link to="/admin">Bảng tin</router-link>
                </template>
            </el-menu-item>
            <el-menu-item index="2">
                <template slot="title">
                    <i class="el-icon-s-grid"></i>
                    <router-link to="/admin/categories"
                        >Quản lý danh mục</router-link
                    >
                </template>
            </el-menu-item>
            <el-submenu index="3">
                <template slot="title">
                    <i class="el-icon-s-cooperation"></i>
                    <span>Quản lý sản phẩm</span>
                </template>
                <el-menu-item-group>
                    <el-menu-item index="3-2">
                        <router-link
                            to="/admin/products"
                            active-class="active-link"
                            >Danh sách sản phẩm</router-link
                        >
                    </el-menu-item>
                    <el-menu-item index="3-3">
                        <router-link
                            to="/admin/units"
                            active-class="active-link"
                            >Đơn vị tính</router-link
                        >
                    </el-menu-item>
                    <el-menu-item index="3-4">
                        <router-link
                            to="/admin/suppliers"
                            active-class="active-link"
                            >Nhà cung cấp</router-link
                        >
                    </el-menu-item>
                </el-menu-item-group>
            </el-submenu>
            <el-menu-item index="4">
                <template slot="title">
                    <i class="el-icon-s-platform"></i>
                    <router-link to="/admin/articles"
                        >Quản lý bài viết</router-link
                    >
                </template>
            </el-menu-item>
            <el-menu-item index="5">
                <template slot="title">
                    <i class="el-icon-s-order"></i>
                    <router-link to="/admin/orders"
                        >Quản lý đơn hàng</router-link
                    >
                </template>
            </el-menu-item>
            <el-menu-item index="6">
                <template slot="title">
                    <i class="el-icon-user-solid"></i>
                    <router-link to="/">Khách hàng</router-link>
                </template>
            </el-menu-item>
            <el-menu-item index="7">
                <template slot="title">
                    <i class="el-icon-star-on"></i>
                    <router-link to="/">Giao diện</router-link>
                </template>
            </el-menu-item>
            <el-menu-item index="8">
                <template slot="title">
                    <i class="el-icon-s-tools"></i>
                    <router-link to="/admin/system">Hệ thống</router-link>
                </template>
            </el-menu-item>
            <el-menu-item index="9">
                <template slot="title">
                    <i class="el-icon-s-custom"></i>
                    <router-link to="/admin/users">Tài khoản</router-link>
                </template>
            </el-menu-item>
        </el-menu>
    </el-aside>
</template>
<script>
export default {
    name: 'v-aside',
}
</script>
<style></style>
