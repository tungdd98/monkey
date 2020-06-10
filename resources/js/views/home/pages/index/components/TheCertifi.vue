<template>
    <div class="certifi-home">
        <div class="container">
            <h3 class="head-primary">
                Chứng chỉ & chứng nhận
                <span
                    >100% sản phẩm có nguồn gốc xuất xứ rõ ràng, có chứng
                    nhận/chứng chỉ.</span
                >
            </h3>
            <carousel
                class="sl-certifi"
                :nav="true"
                :margin="30"
                :dots="false"
                :autoplay="false"
                :loop="true"
                :responsive="responsive"
                :navClass="navClass"
                :navText="navText"
            >
                <a href title class="item">
                    <img src="tomita/images/certifi1.png" alt />
                </a>
                <a href title class="item">
                    <img src="tomita/images/certifi2.png" alt />
                </a>
                <a href title class="item">
                    <img src="tomita/images/certifi3.png" alt />
                </a>
                <a href title class="item">
                    <img src="tomita/images/certifi4.png" alt />
                </a>
                <a href title class="item">
                    <img src="tomita/images/certifi5.png" alt />
                </a>
                <a href title class="item">
                    <img src="tomita/images/certifi5.png" alt />
                </a>
            </carousel>
        </div>
    </div>
</template>
<script>
import carousel from "vue-owl-carousel";
export default {
    data() {
        return {
            responsive: {
                1199: {
                    items: 5
                },
                991: {
                    items: 4
                },
                768: {
                    items: 3
                },
                0: {
                    items: 2
                }
            },
            navClass: ["slide-icon prev", "slide-icon next"],
            navText: [
                "<i class='arrow_left_alt slide-icon prev'></i>",
                "<i class='arrow_right_alt slide-icon next'></i>"
            ]
        };
    },
    components: { carousel }
};
</script>
<style></style>
