<template>
	<div class="wrap">
		<a href title class="icon-cart" data-toggle="modal" data-target="#pu-cart">
			<i class="fa fa-shopping-cart"></i>
			<span>1</span>
		</a>
		<v-header></v-header>
		<router-view></router-view>
		<v-new-letter></v-new-letter>
		<v-footer></v-footer>
	</div>
</template>
<script>
import VFooter from './templates/VFooter'
import VHeader from './templates/VHeader'
import VNewLetter from './templates/VNewLetter'
export default {
	components: {
		VFooter,
		VHeader,
		VNewLetter
	}
};
</script>
<style lang="scss">

</style>