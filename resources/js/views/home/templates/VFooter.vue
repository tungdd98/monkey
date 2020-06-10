<template>
    <footer v-if="info">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="ft-item v1">
                        <a href title class="logo-ft">
                            <img src="tomita/images/logo.png" alt />
                        </a>
                        <h2 class="slogan">{{ _notag(info.brief) }}</h2>
                        <div class="connect">
                            <span>Kết nối với {{ _notag(info.company) }}:</span>
                            <ul class="social-ft">
                                <li v-if="info.facebook">
                                    <a :href="info.facebook" title>
                                        <i class="social_facebook"></i>
                                    </a>
                                </li>
                                <li v-if="info.twitter">
                                    <a :href="info.twitter" title>
                                        <i class="social_twitter"></i>
                                    </a>
                                </li>
                                <li v-if="info.google">
                                    <a :href="info.google" title>
                                        <i class="social_googleplus"></i>
                                    </a>
                                </li>
                                <li v-if="info.gmail">
                                    <a :href="info.gmail" title>
                                        <i class="social_youtube"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="ft-item v2">
                        <h3 class="title">
                            thông tin liên hệ
                            <span class="arrow_carrot-down d-md-none"></span>
                        </h3>
                        <ul class="info hd-mb">
                            <li>
                                <span class="lnr lnr-home"></span>
                                <p>Văn phòng: {{ _notag(info.address) }}</p>
                            </li>
                            <li>
                                <span class="lnr lnr-phone-handset"></span>
                                <p>
                                    Điện thoại:
                                    <a :href="`tel:${info.phone}`" title>{{
                                        _notag(info.phone)
                                    }}</a>
                                </p>
                            </li>
                            <li>
                                <span class="lnr lnr-phone"></span>
                                <p>
                                    Hotline:
                                    <a href="tel:0981 645 533" title>{{
                                        _notag(info.hotline)
                                    }}</a>
                                </p>
                            </li>
                            <li>
                                <span class="lnr lnr-clock"></span>
                                <p>Giờ mở cửa: {{ _notag(info.time) }}</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="ft-item">
                        <h3 class="title">
                            Hỗ trợ khách hàng
                            <span class="arrow_carrot-down d-md-none"></span>
                        </h3>
                        <ul class="quick-link hd-mb">
                            <li>
                                <a href title>Câu hỏi thường gặp</a>
                            </li>
                            <li>
                                <a href title>Hướng dẫn mua hàng</a>
                            </li>
                            <li>
                                <a href title>Hướng dẫn thanh toán</a>
                            </li>
                            <li>
                                <a href title>Chính sách vận chuyển</a>
                            </li>
                            <li>
                                <a href title>Chính sách đổi trả hàng</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="ft-item">
                        <iframe
                            :src="info.fanpage"
                            width="270"
                            height="130"
                            style="border:none;overflow:hidden"
                            scrolling="no"
                            frameborder="0"
                            allowtransparency="true"
                            allow="encrypted-media"
                        ></iframe>
                        <div class="payment">
                            <span>Chấp nhận thanh toán qua:</span>
                            <img src="tomita/images/payment-ft.png" alt />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copy-right">
            {{ _notag(info.copyright) }}
        </div>
    </footer>
</template>
<script>
import axios from "@/plugins/axios";
export default {
    data() {
        return {
            info: null
        };
    },
    created() {
        this.init();
    },
    computed: {},
    methods: {
        async init() {
            try {
                let result = await axios.get("system");
                if (result.status === 200) {
                    this.info = result.data.data[0];
                }
            } catch (error) {
                console.log(error);
            }
        }
    }
};
</script>
<style></style>
