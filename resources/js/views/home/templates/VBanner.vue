<template>
	<section class="bn-page mgt" v-if="path">
		<img :src="getPath" alt />
	</section>
</template>
<script>
import { mapGetters } from 'vuex';
export default {
  data() {
    return {
      path: null
    }
  },
  computed: {
    ...mapGetters({
      categories: 'category/getAll'
    }),
    getPath() {
      if(this.path) {
        return this._getThumbnail('category', this.path)
      }
    }
  },
  watch: {
    '$route' (to, from) {
      let type = to.name
      if(type !== 'product-detail') {
        let item = this.categories.filter(value => value.type == type)
        this.path = item[0].thumbnail  
      }
    }
  }
};
</script>
<style>
</style>