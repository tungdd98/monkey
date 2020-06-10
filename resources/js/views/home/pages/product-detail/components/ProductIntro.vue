<template>
    <div class="product-intro" v-if="item">
        <h3 class="title">Thông tin sản phẩm</h3>
        <div class="s-content" v-html="item.content">
            {{ item.content }}
        </div>
    </div>
</template>
<script>
export default {
    props: {
        item: { type: Object, default: "" }
    }
};
</script>
<style></style>
