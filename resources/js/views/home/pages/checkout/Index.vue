<template>
  <section class="page-checkout page-primary mt-5">
		<div class="container">
      <h2 class="head-primary v2">Thanh toán</h2>
      <div class="checkout__steps">
        <button class="checkout__btn checkout__btn--small checkout__btn--transparent">
          <router-link :to="{ name: 'information' }">Thông tin đơn hàng</router-link>
        </button>
        <button class="checkout__btn checkout__btn--small checkout__btn--transparent">
          <router-link :to="{ name: 'checkout' }">Xác nhận đơn hàng</router-link>
        </button>
      </div>
			<router-view></router-view>
		</div>
	</section>
</template>
<script>
export default {
}
</script>
<style lang="scss">
.checkout__steps {
  position: relative;
  width: 600px;
  margin: 20px auto;
  display: flex;
  justify-content: space-between;
  &::before {
    content: '';
    width: 80%;
    height: 1px;
    background-color: #333;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: -1;
  }
}
.checkout__btn {
	padding: 0 10px;
	height: 48px;
	flex: 0 0 180px;
	min-width: 140px;
	border-radius: 30px;
	background-color: #f75510;
	color: #fff;
	display: flex;
	align-items: center;
	justify-content: center;
	text-transform: uppercase;
	font-size: 16px;
	font-weight: bold;
	transition: 0.2s;
	border: 1px solid #f75510;
	margin-left: auto;
  &--small {
    font-size: 12px;
    height: 36px;
    margin: auto;
  }
  &--transparent {
    background-color: #fff;
    color: #f75510;
  }
}
</style>