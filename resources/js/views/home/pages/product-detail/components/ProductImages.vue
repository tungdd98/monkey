<template>
    <div class="sl-img-pro">
        <span class="sales v2">-10%</span>
        <slick
            :options="topSlick.options"
            class="pro-img"
            :ref="topSlick.name"
            v-if="images"
        >
            <div class="item" v-for="(image, index) in images" :key="index">
                <a
                    :href="_getThumbnail('product', image)"
                    class="c-img"
                    data-fancybox="gallery"
                    ><img :src="_getThumbnail('product', image)" alt=""
                /></a>
            </div>
        </slick>
        <slick
            :options="bottomSlick.options"
            class="pro-thumb"
            :ref="bottomSlick.name"
            v-if="images"
        >
            <div class="item" v-for="(image, index) in images" :key="index">
                <a
                    :href="_getThumbnail('product', image)"
                    class="c-img"
                    data-fancybox="gallery"
                    ><img :src="_getThumbnail('product', image)" alt=""
                /></a>
            </div>
        </slick>
    </div>
</template>
<script>
import Slick from "vue-slick";
export default {
    data() {
        return {
            topSlick: {
                name: "top",
                options: {
                    arrows: false,
                    swipeToSlide: true,
                    asNavFor: ".pro-thumb"
                }
            },
            bottomSlick: {
                name: "bottom",
                options: {
                    slidesToShow: 7,
                    slidesToScroll: 1,
                    nextArrow: '<i class="fa fa-angle-right smooth next"></i>',
                    prevArrow: '<i class="fa fa-angle-left smooth prev"></i>',
                    autoplay: false,
                    swipeToSlide: true,
                    autoplaySpeed: 5000,
                    asNavFor: ".pro-img",
                    focusOnSelect: true,
                    responsive: [
                        {
                            breakpoint: 1199,
                            settings: {
                                slidesToShow: 6
                            }
                        },
                        {
                            breakpoint: 991,
                            settings: {
                                slidesToShow: 8
                            }
                        },
                        {
                            breakpoint: 580,
                            settings: {
                                centerMode: false,
                                slidesToShow: 6
                            }
                        },
                        {
                            breakpoint: 376,
                            settings: {
                                centerMode: false,
                                slidesToShow: 5
                            }
                        }
                    ]
                }
            }
        };
    },
    props: {
        item: { type: Object, default: {} }
    },
    computed: {
        images() {
            if (this.item) {
                return JSON.parse(this.item.images);
            }
            return [];
        }
    },
    methods: {
        next() {
            this.$refs.top.next();
            this.$refs.bottom.next();
        },
        prev() {
            this.$refs.top.prev();
            this.$refs.bottom.prev();
        }
    },
    components: {
        Slick
    }
};
</script>
<style></style>
