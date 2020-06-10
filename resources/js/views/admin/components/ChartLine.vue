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
                    backgroundColor: '#fff',
                    data: [20, 24, 30, 36, 17, 15, 21],
                    fill: false,
                    borderColor: '#fff',
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
            scales: {
                xAxes: [
                    {
                        display: false,
                    },
                ],
                yAxes: [
                    {
                        display: false,
                    },
                ],
            },
            legend: {
                display: false,
            },
        },
    }),

    mounted() {
        this.renderChart(this.chartdata, this.options)
    },
}
</script>

<style></style>
