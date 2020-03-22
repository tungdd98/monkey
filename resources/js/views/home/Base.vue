<template>
	<div class="wrap">
		<v-popup-cart></v-popup-cart>
		<v-popup-login></v-popup-login>
		<v-header></v-header>
		<v-banner></v-banner>
		<router-view></router-view>
		<v-new-letter></v-new-letter>
		<v-footer></v-footer>
	</div>
</template>
<script>
import VFooter from './templates/VFooter'
import VHeader from './templates/VHeader'
import VNewLetter from './templates/VNewLetter'
import VBanner from './templates/VBanner'
import VPopupCart from './templates/VPopupCart'
import VPopupLogin from './templates/VPopupLogin'
export default {
	components: {
		VFooter,
		VHeader,
		VNewLetter,
		VBanner,
		VPopupCart,
		VPopupLogin
	}
};
</script>
<style lang="scss">

</style>