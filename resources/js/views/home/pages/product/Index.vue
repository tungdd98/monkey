<template>
    <section class="page-product page-primary">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">Trang chủ</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#">Sản phẩm</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Thực phẩm tươi sống
                    </li>
                </ol>
            </nav>
            <h2 class="head-primary v3">Thực phẩm tươi sống</h2>
            <div class="wrap-pro-list">
                <div class="row">
                    <div class="col-lg-9">
                        <product-list></product-list>
                    </div>
                    <div class="col-lg-3">
                        <product-nav></product-nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
import ProductList from "./components/ProductList";
import ProductNav from "./components/ProductNav";
export default {
    components: {
        ProductList,
        ProductNav
    }
};
</script>
<style></style>
