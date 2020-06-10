<template>
    <section class="bn-page mgt" v-if="path">
        <img :src="getPath" alt />
    </section>
</template>
<script>
import { mapGetters } from "vuex";
export default {
    data() {
        return {
            path: null,
            type: this.$route.name
        };
    },
    computed: {
        ...mapGetters({
            categories: "category/getCategoryAll"
        }),
        getPath() {
            if (this.path) {
                return this._getThumbnail("category", this.path);
            }
        }
    },
    watch: {
        $route(to, from) {
            this.type = to.name;
            this.changePath();
        }
    },
    created() {
        this.init();
    },
    methods: {
        init() {
            this.$store.dispatch("category/getTomitaCategory", {}).then(res => {
                if (res.flag) {
                    this.changePath();
                }
            });
        },
        changePath() {
            if (
                ![
                    "profile",
                    "product-detail",
                    "history-order",
                    "checkout",
                    "information",
                    "article-detail"
                ].includes(this.type)
            ) {
                let item = this.categories.filter(
                    value => value.type == this.type
                );
                this.path = item[0].thumbnail;
            }
        }
    }
};
</script>
<style></style>
