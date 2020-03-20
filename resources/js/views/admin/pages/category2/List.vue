<template>
	<div>
		<el-tree :data="data" :props="defaultProps"></el-tree>
	</div>
</template>
<script>
const CONTROLLER = "category";
import { mapActions, mapGetters } from "vuex";
export default {
	data() {
		return {
			data: [
				{
					label: "Level one 1",
					children: [
						{
							label: "Level two 1-1",
							children: [
								{
									label: "Level three 1-1-1"
								}
							]
						}
					]
				},
				{
					label: "Level one 2",
					children: [
						{
							label: "Level two 2-1",
							children: [
								{
									label: "Level three 2-1-1"
								}
							]
						},
						{
							label: "Level two 2-2",
							children: [
								{
									label: "Level three 2-2-1"
								}
							]
						}
					]
				},
				{
					label: "Level one 3",
					children: [
						{
							label: "Level two 3-1",
							children: [
								{
									label: "Level three 3-1-1"
								}
							]
						},
						{
							label: "Level two 3-2",
							children: [
								{
									label: "Level three 3-2-1"
								}
							]
						}
					]
				}
			],
			defaultProps: {
				children: "children",
				label: "label"
			},
      category: [],
		};
	},
	computed: {
		...mapGetters({
			items: "category/getAll"
		})
	},
	created() {
		this.getMultiCategory().then(res => {
      if(res.flag) {
        let categories = [...res.data]
        this.show(categories)
        console.log(this.category)
      }
    });
	},
	methods: {
    ...mapActions("category", ["getList", "getMultiCategory"]),
    show(data, parent_id = 0) {
      data.forEach((value, key, arr) => {
        this.category.push({
          label: value.title
        })
      })
    }
	}
};
</script>
<style>
</style>