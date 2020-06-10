<template>
    <section class="page-checkout page-primary mt-5">
        <div class="container">
            <h2 class="head-primary v2">Thanh toán</h2>
            <div class="text-center" v-if="!user">
                <small class="text-center text-danger font-italic"
                    >Hãy đăng nhập để quản lý đơn hàng 1 cách tốt nhất!</small
                >
            </div>
            <router-view></router-view>
        </div>
    </section>
</template>
<script>
import { mapGetters, mapActions } from "vuex";

export default {
    computed: {
        ...mapGetters({
            user: "auth/getUser"
        })
    }
};
</script>
<style lang="scss">
.checkout__btn {
    padding: 0 10px;
    height: 48px;
    flex: 0 0 180px;
    min-width: 140px;
    border-radius: 30px;
    background-color: #f75510;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    text-transform: uppercase;
    font-size: 16px;
    font-weight: bold;
    transition: 0.2s;
    border: 1px solid #f75510;
    margin-left: auto;
    &--small {
        font-size: 12px;
        height: 36px;
        margin: auto;
    }
    &--transparent {
        background-color: #fff;
        color: #f75510;
    }
}
</style>
