<template>
    <section class="page-primary v2">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">Trang chủ</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#">Tài khoản</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Thông tin tài khoản
                    </li>
                </ol>
            </nav>
            <div class="wrap-account">
                <div class="row">
                    <div class="col-lg-3">
                        <nav-account></nav-account>
                    </div>
                    <div class="col-lg-9">
                        <router-view></router-view>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
import NavAccount from "./components/NavAccount";
export default {
    components: {
        NavAccount
    }
};
</script>
<style></style>
