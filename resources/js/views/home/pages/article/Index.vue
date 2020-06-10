<template>
    <section class="page-news page-primary">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">Trang chủ</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Tin tức
                    </li>
                </ol>
            </nav>
            <h2 class="head-primary v2">Tin tức & sự kiện</h2>
            <div class="list-news" v-if="items && items.length">
                <div class="row">
                    <div
                        class="col-md-6"
                        v-for="item in items"
                        :key="item.id"
                        :item="item"
                    >
                        <div class="item-news">
                            <router-link
                                :title="_slug(item.title)"
                                :to="getLinkItem(item)"
                                class="img-primary"
                            >
                                <img
                                    :src="
                                        _getThumbnail('article', item.thumbnail)
                                    "
                                    alt
                                />
                            </router-link>
                            <div class="ct">
                                <h3 class="title">
                                    <router-link
                                        :title="_slug(item.title)"
                                        :to="getLinkItem(item)"
                                        >{{ _notag(item.title) }}</router-link
                                    >
                                </h3>
                                <div class="desc" v-html="item.description">
                                    {{ item.description }}
                                </div>
                                <div class="control">
                                    <span class="time">
                                        <i class="icon_clock_alt"></i>
                                        {{
                                            _dateFormat(
                                                item.created_at,
                                                "short"
                                            )
                                        }}
                                    </span>
                                    <a href title class="btn-view-dt">
                                        Xem chi tiết
                                        <i class="arrow_right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <nav aria-label="Page navigation">
                    <el-pagination
                        v-if="total > 0"
                        background
                        class="kr-pagination"
                        layout="prev, pager, next"
                        @current-change="handleCurrChange"
                        :page-size="12"
                        :total="total"
                    ></el-pagination>
                </nav>
            </div>
        </div>
    </section>
</template>
<script>
export default {
    name: "artile",
    data() {
        return {
            items: []
        };
    },
    computed: {
        total() {
            return this.items.length;
        }
    },
    async created() {
        await this.$store.dispatch("article/getListTomita").then(res => {
            this.items = res.data.data;
        });
    },
    methods: {
        async handleCurrChange(val) {
            await this.$store.dispatch("article/getListTomita").then(res => {
                this.items = res.data.data;
            });
        },
        getLinkItem(item) {
            return {
                name: "article-detail",
                params: {
                    id: item.id
                }
            };
        }
    }
};
</script>
<style></style>
