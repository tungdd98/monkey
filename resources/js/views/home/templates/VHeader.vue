<template>
    <header
        style="background: url(../tomita/images/bg-header.png) top center no-repeat;"
    >
        <div class="container">
            <div class="wrap-head">
                <nav class="d-nav v1">
                    <div class="logo-mb">
                        <a href="index.html">
                            <img src="images/logo.png" />
                        </a>
                    </div>
                    <ul>
                        <li v-for="item in menuLeft" :key="item.id">
                            <router-link
                                :to="getLinkCategoryNoChild(item)"
                                class="smooth"
                                >{{ item.title }}</router-link
                            >
                            <ul
                                v-if="item.children && item.children.length > 0"
                            >
                                <li
                                    v-for="item in item.children"
                                    :key="item.id"
                                >
                                    <router-link
                                        :to="getLinkCategoryWithChild(item)"
                                        class="smooth"
                                        >{{ item.title }}</router-link
                                    >
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <router-link to="/admin" class="logo">
                    <img src="tomita/images/logo.png" alt />
                </router-link>
                <div class="head-right">
                    <nav class="d-nav">
                        <ul>
                            <li v-for="item in menuRight" :key="item.id">
                                <router-link
                                    :to="getLinkCategoryNoChild(item)"
                                    class="smooth"
                                    >{{ item.title }}</router-link
                                >
                            </li>
                        </ul>
                    </nav>
                    <div class="head-crt">
                        <div class="head-search">
                            <span class="ic-search">
                                <i class="icon_search"></i>
                            </span>
                            <div class="form-search">
                                <div class="form-group">
                                    <input
                                        type="text"
                                        placeholder="Tìm kiếm ..."
                                    />
                                    <button type="submit">
                                        <i class="icon_search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <a
                            href="javascript:;"
                            title
                            class="head-login"
                            data-toggle="modal"
                            data-target="#pu-login"
                            v-if="!user"
                        >
                            <i class="lnr lnr-user"></i>
                            <span>Đăng nhập</span>
                        </a>
                        <el-dropdown
                            trigger="click"
                            v-else
                            style="margin-left: 20px"
                        >
                            <el-avatar
                                src="https://cube.elemecdn.com/0/88/03b0d39583f48206768a7534e55bcpng.png"
                            ></el-avatar>
                            <el-dropdown-menu slot="dropdown">
                                <el-dropdown-item>
                                    <span>{{ user.name }}</span>
                                </el-dropdown-item>
                                <el-dropdown-item icon="el-icon-plus">
                                    <router-link to="/profile"
                                        >Trang cá nhân</router-link
                                    >
                                </el-dropdown-item>
                                <el-dropdown-item icon="el-icon-circle-plus">
                                    <router-link to="/history-order"
                                        >Lịch sử mua hàng</router-link
                                    >
                                </el-dropdown-item>
                                <el-dropdown-item icon="el-icon-circle-plus">
                                    <span @click="handleLogout">Đăng xuất</span>
                                </el-dropdown-item>
                            </el-dropdown-menu>
                        </el-dropdown>
                    </div>
                </div>
                <div class="icon-menu open-mnav">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
    </header>
</template>
<script>
import { mapActions, mapGetters } from "vuex";
import foo from "@/configs";

export default {
    data() {
        return {
            items: []
        };
    },
    computed: {
        ...mapGetters({
            user: "auth/getUser"
        }),
        menuLeft() {
            return this.items.filter((value, key) => key <= 3);
        },
        menuRight() {
            return this.items.filter((value, key) => key > 3);
        }
    },
    created() {
        this.getTomitaCategory({ action: "tree" }).then(res => {
            if (res.flag) {
                this.items = res.data;
                this.items.forEach((value, key) => {
                    Object.entries(foo.URL).forEach(([idx, val]) => {
                        if (value.type === idx) {
                            value["url"] = val;
                        }
                    });
                });
            }
        });
    },
    methods: {
        ...mapActions("category", ["getList", "getTomitaCategory"]),
        getLinkCategoryNoChild(category) {
            return {
                name: category.type
            };
        },
        getLinkCategoryWithChild(category) {
            return {
                name: category.type,
                query: {
                    category: this._slug(category.title),
                    tag: category.id
                }
            };
        },
        handleLogout() {
            this.$store.dispatch("auth/logout");
        }
    }
};
</script>
<style></style>
