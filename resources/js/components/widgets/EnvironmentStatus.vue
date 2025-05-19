<template>
    <div style="height:100%">
        <div class="content-center">
            <div class="text-center">
                <b-icon icon="thermometer-half" font-scale="2"></b-icon>
                <h5 class="pt-2">Temperatur:</h5>
                <h5 class="pb-3">{{ (this.dataObject.currentTemperature-1000)/10 }}C°</h5>
            </div>
            <div class="text-center pt-3">
                <b-icon icon="droplet" font-scale="2"></b-icon>
                <h5 class="pt-2">Luftfeuchtigkeit:</h5>
                <h5>{{ (this.dataObject.currentHumidity-1000)/10 }}%</h5>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "environmentStatus",
    props: {
        dataObject: {
            type: Object,
            required: true
        }
    }
};
</script>
<style scoped>
.content-center {
    /*position: relative;
    top: 50%;
    -webkit-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    transform: translateY(-50%);*/
}
@media (max-width: 767px) {
  .content-center {
    -webkit-transform: translateY(0%);
    -ms-transform: translateY(0%);
    transform: translateY(0%);
  }
}
</style>
