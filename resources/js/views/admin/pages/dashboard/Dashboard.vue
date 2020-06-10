<template>
    <div class="v-dashboard">
        <el-row :gutter="20">
            <el-col :md="6" :lg="6">
                <el-card class="v-card bg-gradient-primary">
                    <div class="v-card__number">1998</div>
                    <div class="v-card__desc">Member online</div>
                    <chart-line />
                </el-card>
            </el-col>
            <el-col :md="6" :lg="6">
                <el-card class="v-card bg-gradient-info">
                    <div class="v-card__number">1998</div>
                    <div class="v-card__desc">Member online</div>
                    <chart-line />
                </el-card>
            </el-col>
            <el-col :md="6" :lg="6">
                <el-card class="v-card bg-gradient-warning">
                    <div class="v-card__number">1998</div>
                    <div class="v-card__desc">Member online</div>
                    <chart-line />
                </el-card>
            </el-col>
            <el-col :md="6" :lg="6">
                <el-card class="v-card bg-gradient-danger">
                    <div class="v-card__number">1998</div>
                    <div class="v-card__desc">Member online</div>
                    <chart-line />
                </el-card>
            </el-col>
        </el-row>
        <el-card class="v-card-big">
            <div slot="header" class="v-card-big__header">
                <h4 class="v-card-big__title">Traffic</h4>
                <div class="v-card-big__small">November 2020</div>
            </div>
            <chart-line-big />
            <div class="v-card-big__footer">
                <el-row :gutter="20" class="text-center">
                    <el-col :md="6">
                        <div class="v-card-big__footer-title">Visits</div>
                        <strong class="v-card-big__footer-desc"
                            >29.703 Users (40%)</strong
                        >
                        <el-progress
                            :percentage="50"
                            :show-text="false"
                        ></el-progress>
                    </el-col>
                    <el-col :md="6">
                        <div class="v-card-big__footer-title">Unique</div>
                        <strong class="v-card-big__footer-desc"
                            >29.703 Users (40%)</strong
                        >
                        <el-progress
                            :percentage="20"
                            :show-text="false"
                            status="success"
                        ></el-progress>
                    </el-col>
                    <el-col :md="6">
                        <div class="v-card-big__footer-title">Pageviews</div>
                        <strong class="v-card-big__footer-desc"
                            >29.703 Users (40%)</strong
                        >
                        <el-progress
                            :percentage="60"
                            :show-text="false"
                            status="warning"
                        ></el-progress>
                    </el-col>
                    <el-col :md="6">
                        <div class="v-card-big__footer-title">New Users</div>
                        <strong class="v-card-big__footer-desc"
                            >29.703 Users (40%)</strong
                        >
                        <el-progress
                            :percentage="80"
                            :show-text="false"
                            status="exception"
                        ></el-progress>
                    </el-col>
                </el-row>
            </div>
        </el-card>
    </div>
</template>
<script>
import ChartLine from '../../components/ChartLine'
import ChartLineBig from '../../components/ChartLineBig'
export default {
    name: 'dash-board',
    components: {
        ChartLine,
        ChartLineBig,
    },
}
</script>
<style lang="scss">
.v-card {
    color: #fff;
    .el-card__body {
        padding: 14px;
    }
    &__number {
        font-size: 20px;
        font-weight: 600;
    }
    .chartjs-render-monitor {
        height: 70px;
    }
}
.v-card-big {
    margin: 20px 0;
    text-align: center;
    &__title {
        margin-top: 0;
        margin-bottom: 5px;
        font-size: 20px;
        font-weight: 600;
    }
    &__small {
        font-size: 12px;
        color: #333;
    }
    &__footer {
        margin-top: 20px;
        &-title {
            color: #333;
        }
        &-desc {
            display: inline-block;
            margin-bottom: 5px;
        }
    }
}
.bg-gradient-primary {
    background: linear-gradient(45deg, #321fdb, #1f1498);
}
.bg-gradient-info {
    background: linear-gradient(45deg, #39f, #2982cc);
}
.bg-gradient-warning {
    background: linear-gradient(45deg, #f9b115, #f6960b);
}
.bg-gradient-danger {
    background: linear-gradient(45deg, #e55353, #d93737);
}
</style>
