<template>
    <div class="v-loading-home" v-if="isLoadingHome">
        <div class="loadingio-spinner-ellipsis-w11vhu8kux">
            <div class="ldio-qbq7ik3lici">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapState } from "vuex";
export default {
    name: "v-loading-home",
    computed: {
        ...mapState({
            isLoadingHome: "isLoadingHome"
        })
    }
};
</script>
