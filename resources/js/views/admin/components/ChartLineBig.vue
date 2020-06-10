<script>
import { Line } from 'vue-chartjs'

export default {
    extends: Line,
    data: () => ({
        chartdata: {
            labels: [
                'Monday',
                'Tuesday',
                'Wednesday',
                'Thursday',
                'Friday',
                'Saturday',
                'Sunday',
            ],
            datasets: [
                {
                    label: 'Month',
                    backgroundColor: '#F56C6C',
                    data: [20, 24, 30, 36, 17, 15, 21],
                    fill: false,
                    borderColor: '#F56C6C',
                    borderWidth: 1,
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            tooltips: {
                enabled: true,
                intersect: true,
                mode: 'index',
                position: 'nearest',
                titleFontFamily: 'Segoe UI',
                bodyFontFamily: 'Segoe UI',
            },
            legend: {
                labels: {
                    fontFamily: 'Segoe UI',
                },
            },
        },
    }),

    mounted() {
        this.renderChart(this.chartdata, this.options)
    },
}
</script>

<style></style>
