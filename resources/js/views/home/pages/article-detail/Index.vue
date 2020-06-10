<template>
    <section class="page-news-dt page-primary v2">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">Trang chủ</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#">Tin tức</a>
                    </li>
                </ol>
            </nav>
            <div class="wrap-news-dt">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="details-news" v-if="item">
                            <h1 class="title-news">{{ _notag(item.title) }}</h1>
                            <div class="control">
                                <span class="time">
                                    <i class="icon_clock_alt"></i>
                                    {{ _dateFormat(item.created_at, "short") }}
                                </span>
                            </div>
                            <div class="desc" v-html="item.description">
                                {{ item.description }}
                            </div>
                            <div class="desc" v-html="item.content">
                                {{ item.content }}
                            </div>
                            <div class="control v2">
                                <div class="like-share">
                                    <iframe
                                        src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&width=200&layout=button_count&action=like&size=small&show_faces=false&share=true&height=46&appId=1863080223943997"
                                        width="200"
                                        height="46"
                                        style="border:none;overflow:hidden"
                                        scrolling="no"
                                        frameborder="0"
                                        allowtransparency="true"
                                        allow="encrypted-media"
                                    ></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="sb-news">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a
                                        class="nav-link active"
                                        data-toggle="tab"
                                        href="#tabs1"
                                        >Tin liên quan</a
                                    >
                                </li>
                                <li class="nav-item">
                                    <a
                                        class="nav-link"
                                        data-toggle="tab"
                                        href="#tabs2"
                                        >Tin mới nhất</a
                                    >
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div
                                    class="tab-pane fade show active"
                                    id="tabs1"
                                >
                                    <div class="item-sb-news">
                                        <a href title class="img-primary">
                                            <img
                                                src="images/sb-news1.jpg"
                                                alt
                                            />
                                        </a>
                                        <div class="ct">
                                            <h3 class="title">
                                                <a href title
                                                    >Chương trình ưu đãi giảm
                                                    15% ngày vàng thực phẩm sạch
                                                    tại TOMITA MART trong ngày
                                                    24/08</a
                                                >
                                            </h3>
                                            <span class="time">
                                                <i class="icon_clock_alt"></i>
                                                05/11/2018
                                            </span>
                                        </div>
                                    </div>
                                    <div class="item-sb-news">
                                        <a href title class="img-primary">
                                            <img
                                                src="images/sb-news2.jpg"
                                                alt
                                            />
                                        </a>
                                        <div class="ct">
                                            <h3 class="title">
                                                <a href title
                                                    >Hội thảo dinh dưỡng cho phụ
                                                    huynh có con ở lứa tuổi tiểu
                                                    học</a
                                                >
                                            </h3>
                                            <span class="time">
                                                <i class="icon_clock_alt"></i>
                                                05/11/2018
                                            </span>
                                        </div>
                                    </div>
                                    <div class="item-sb-news">
                                        <a href title class="img-primary">
                                            <img
                                                src="images/sb-news3.jpg"
                                                alt
                                            />
                                        </a>
                                        <div class="ct">
                                            <h3 class="title">
                                                <a href title
                                                    >Những tác dụng dinh dưỡng
                                                    không ngờ tới của cá hồi đối
                                                    với sức khỏe</a
                                                >
                                            </h3>
                                            <span class="time">
                                                <i class="icon_clock_alt"></i>
                                                05/11/2018
                                            </span>
                                        </div>
                                    </div>
                                    <div class="item-sb-news">
                                        <a href title class="img-primary">
                                            <img
                                                src="images/sb-news4.jpg"
                                                alt
                                            />
                                        </a>
                                        <div class="ct">
                                            <h3 class="title">
                                                <a href title
                                                    >Làm sao để nâng cao sức đề
                                                    kháng phòng ốm vặt cho trẻ
                                                    em thời điểm giao mùa ???</a
                                                >
                                            </h3>
                                            <span class="time">
                                                <i class="icon_clock_alt"></i>
                                                05/11/2018
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tabs2">
                                    <div class="item-sb-news">
                                        <a href title class="img-primary">
                                            <img
                                                src="images/sb-news1.jpg"
                                                alt
                                            />
                                        </a>
                                        <div class="ct">
                                            <h3 class="title">
                                                <a href title
                                                    >Chương trình ưu đãi giảm
                                                    15% ngày vàng thực phẩm sạch
                                                    tại TOMITA MART trong ngày
                                                    24/08</a
                                                >
                                            </h3>
                                            <span class="time">
                                                <i class="icon_clock_alt"></i>
                                                05/11/2018
                                            </span>
                                        </div>
                                    </div>
                                    <div class="item-sb-news">
                                        <a href title class="img-primary">
                                            <img
                                                src="images/sb-news2.jpg"
                                                alt
                                            />
                                        </a>
                                        <div class="ct">
                                            <h3 class="title">
                                                <a href title
                                                    >Hội thảo dinh dưỡng cho phụ
                                                    huynh có con ở lứa tuổi tiểu
                                                    học</a
                                                >
                                            </h3>
                                            <span class="time">
                                                <i class="icon_clock_alt"></i>
                                                05/11/2018
                                            </span>
                                        </div>
                                    </div>
                                    <div class="item-sb-news">
                                        <a href title class="img-primary">
                                            <img
                                                src="images/sb-news3.jpg"
                                                alt
                                            />
                                        </a>
                                        <div class="ct">
                                            <h3 class="title">
                                                <a href title
                                                    >Những tác dụng dinh dưỡng
                                                    không ngờ tới của cá hồi đối
                                                    với sức khỏe</a
                                                >
                                            </h3>
                                            <span class="time">
                                                <i class="icon_clock_alt"></i>
                                                05/11/2018
                                            </span>
                                        </div>
                                    </div>
                                    <div class="item-sb-news">
                                        <a href title class="img-primary">
                                            <img
                                                src="images/sb-news4.jpg"
                                                alt
                                            />
                                        </a>
                                        <div class="ct">
                                            <h3 class="title">
                                                <a href title
                                                    >Làm sao để nâng cao sức đề
                                                    kháng phòng ốm vặt cho trẻ
                                                    em thời điểm giao mùa ???</a
                                                >
                                            </h3>
                                            <span class="time">
                                                <i class="icon_clock_alt"></i>
                                                05/11/2018
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="block-qc">
                                <a href title>
                                    <img src="images/bn-qc1.jpg" alt />
                                </a>
                            </div>
                            <div class="block-qc">
                                <a href title>
                                    <img src="images/bn-qc2.jpg" alt />
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
import { mapActions, mapGetters } from "vuex";
export default {
    name: "article-detail",
    data() {
        return {
            id: this.$route.params.id
        };
    },
    watch: {
        $route(to, from) {
            this.id = to.params.id;
            this.getItemById(this.id);
        }
    },
    computed: {
        ...mapGetters({
            item: "article/getCurrItem"
        })
    },
    created() {
        this.getItemById(this.id);
    },
    methods: {
        ...mapActions("article", ["getItemById"])
    },
    mounted() {}
};
</script>
<style></style>
