<template>
    <div class="sb-product">
        <div class="block-cate-pro">
            <h3 class="title">Danh mục sản phẩm</h3>
            <div id="accordion" v-if="getNav">
                <div
                    class="card"
                    v-for="item in getNav.children"
                    :key="item.id"
                >
                    <div class="card-header">
                        <a
                            class="card-link"
                            data-toggle="collapse"
                            :href="`#collap${item.id}`"
                            >{{ _notag(item.title) }}</a
                        >
                    </div>
                    <div
                        v-if="item.children.length > 0"
                        :id="`collap${item.id}`"
                        class="collapse show"
                        data-parent="#accordion"
                    >
                        <div class="card-body">
                            <ul>
                                <li
                                    v-for="item2 in item.children"
                                    :key="item2.id"
                                >
                                    <router-link
                                        :to="getLinkCategoryWithChild(item2)"
                                        >{{ _notag(item2.title) }}</router-link
                                    >
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="block-qc v2">
            <a href title>
                <img src="tomita/images/bn-qc1.jpg" alt />
            </a>
        </div>
        <div class="block-qc v2">
            <a href title>
                <img src="tomita/images/bn-qc2.jpg" alt />
            </a>
        </div>
    </div>
</template>
<script>
import { mapGetters } from "vuex";
export default {
    computed: {
        ...mapGetters({
            categories: "category/getCategoryTree"
        }),
        getNav() {
            return this.categories.filter(
                category => category.type === "Product"
            )[0];
        }
    },
    methods: {
        getLinkCategoryWithChild(category) {
            return {
                name: category.type,
                query: {
                    category: this._slug(category.title),
                    tag: category.id
                }
            };
        }
    }
};
</script>
<style></style>
