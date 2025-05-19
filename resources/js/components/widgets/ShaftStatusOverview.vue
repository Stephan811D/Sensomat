<template>
<div>
 <!--<div class="card mb-4 box-shadow">-->
    <!--<div class="card-body">-->
        <h3 class="card-title pricing-card-title">{{automatName}}</h3>
        <div class="chart-wrapper">
            <apexchart type="bar" height="350" :options="chartOptions" :series="series"></apexchart>
        </div>
    <!--</div>-->
  </div>
</template>

<script>
 export default {
  name: 'HelloWorld',
  props: {
    automatName: {
      type: String,
      required: true
    },
    automatId: Number

  },
  data: () => ({
          series: [{
            name: 'Da',
            data: [27, 15, 41, 67, 22,44, 55, 41, 67, 22,44, 55, 41, 67, 22,44, 55, 41, 67, 22,]
          }, {
            name: 'Fehlend',
            data: [3, 15, 20, 8, 13,13, 23, 20, 8, 13,13, 23, 20, 8, 13,13, 23, 20, 8, 13,]
          }],
       chartOptions: {
            chart: {
              type: 'bar',
              width: 850,
              stacked: true,
              toolbar: {
                show: false
              },
              zoom: {
                enabled: false
              },
              animations: {
                enabled: true,
                easing: 'easeinout',
                speed: 1000,
                animateGradually: {
                    enabled: true,
                    delay: 10050
                },
                dynamicAnimation: {
                    enabled: true,
                    speed: 3550
                }
              }
            },
            responsive: [{
              breakpoint: 480,
              options: {
                legend: {
                  position: 'bottom',
                  offsetX: -10,
                  offsetY: 0
                }
              }
            }],
            plotOptions: {
              bar: {
                horizontal: false,
              },
            },
            xaxis: {
              type: 'string',
              categories: ['S01','S01','S01','S01','S01','S01','S01','S01','S01','S01','S01','S01','S01','S01','S01','S01','S01','S01','S01','S01'],
            },
            //legend: {
            //  position: 'right',
            //  offsetY: 40
            //},
            fill: {
              opacity: 1
            },

          },
  }),
  mounted(){this.getData()},
  methods: {
    getData: function(){
      axios.get('/api/automat/fillingLevel/' + this.automatId)
              .then((response) => {
                  this.series = response.data;
                  console.log(response.data);
              })
              .catch(function (error) {
                  console.log(error);
              });
      }
  }
 }
</script>
