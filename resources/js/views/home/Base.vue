<template>
    <div class="wrap">
        <v-popup-cart></v-popup-cart>
        <v-popup-login></v-popup-login>
        <v-header></v-header>
        <v-banner></v-banner>
        <router-view></router-view>
        <v-new-letter></v-new-letter>
        <v-footer></v-footer>
        <v-loading></v-loading>
    </div>
</template>
<script>
import VFooter from './templates/VFooter'
import VHeader from './templates/VHeader'
import VNewLetter from './templates/VNewLetter'
import VBanner from './templates/VBanner'
import VPopupCart from './templates/VPopupCart'
import VPopupLogin from './templates/VPopupLogin'
import VLoading from './templates/VLoading'
export default {
    components: {
        VFooter,
        VHeader,
        VNewLetter,
        VBanner,
        VPopupCart,
        VPopupLogin,
        VLoading,
    },
    created() {
        ;(function(s, u, b, i, z) {
            u[i] =
                u[i] ||
                function() {
                    u[i].t = +new Date()
                    ;(u[i].q = u[i].q || []).push(arguments)
                }
            z = s.createElement('script')
            var zz = s.getElementsByTagName('script')[0]
            z.async = 1
            z.src = b
            z.id = 'subiz-script'
            zz.parentNode.insertBefore(z, zz)
        })(
            document,
            window,
            'https://widgetv4.subiz.com/static/js/app.js',
            'subiz'
        )
        subiz('setAccount', 'acqrnkfbkxogpyanjlcs')
    },
}
</script>
<style lang="scss">
.wrap {
    position: relative;
}
</style>
