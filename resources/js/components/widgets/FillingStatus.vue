<template>
    <div>
        <div class="chart-wrapper">
            <apexchart
                type="radialBar"
                height="240"
                :options="chartOptions"
                :series="series"
            ></apexchart>
        </div>
    </div>
</template>

<script>
export default {
    name: "fillingStatus",
    props: {
        series: {
            type: Array,
            required: true
        }
    },
    data: () => ({
        chartOptions: {
            chart: {
                height: 250,
                type: "radialBar",
                fontFamily: "Nunito, sans-serif"
            },
            colors: [
                function({ value, seriesIndex, w }) {
                    if (value <= 25) {
                        return "#dc3545";
                    } else if (value <= 50) {
                        return "#ffc107";
                    } else {
                        return "#28a745";
                    }
                }
            ],
            plotOptions: {
                radialBar: {
                    hollow: {
                        size: "60%"
                    }
                }
            },
            labels: ["Füllstand"]
        },
    })
};
</script>
