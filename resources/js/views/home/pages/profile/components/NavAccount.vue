<template>
    <div class="sb-account">
        <h3 class="title">
            <img src="tomita/images/ic-user.jpg" alt />Tài khoản của tôi
        </h3>
        <ul>
            <li>
                <router-link :to="{ name: 'profile' }" activeClass="kr-active">
                    <i class="lnr lnr-user"></i>Thông tin cá nhân
                </router-link>
            </li>
            <li>
                <router-link
                    :to="{ name: 'history-order' }"
                    activeClass="kr-active"
                >
                    <i class="lnr lnr-history"></i>Lịch sử mua hàng
                </router-link>
            </li>
            <li>
                <a href title @click.prevent="handleLogout">
                    <i class="lnr lnr-exit"></i>Đăng xuất
                </a>
            </li>
        </ul>
    </div>
</template>
<script>
export default {
    methods: {
        handleLogout() {
            this.$store.dispatch("auth/logout").then(res => {
                if (res.flag) {
                    this.$router.push("/");
                }
            });
        }
    }
};
</script>
<style>
.kr-active {
    color: #f75510;
}
</style>
