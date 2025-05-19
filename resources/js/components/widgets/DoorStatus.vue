<template>
  <div style="height: 100%">
    <div class="content-center">
      <div class="text-center">
        <b-icon :icon="this.currentDoorStateIcon" font-scale="2.5"></b-icon>
        <h5 class="pt-3">Türstatus:</h5>
        <h5 class="pb-3">{{ this.currentDoorState }}</h5>
        <h5 class="pt-2">Letzte Öffnung:</h5>
        <h5>{{ this.dataObject.lastDoorState }}</h5>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "doorStatus",
  props: {
    dataObject: {
      type: Object,
      required: true,
    },
  },
  data: () => ({
    currentDoorState: null,
    currentDoorStateIcon: null,
    lastTimeOpen: null,
    interval: null,
  }),
  watch: {
    dataObject(to, from) {
      this.setDoorState(this.dataObject.doorStateOpen);
    },
  },
  methods: {
    setDoorState: function (data) {
      if (data == 1) {
        this.currentDoorState = "offen";
        this.currentDoorStateIcon = "door-open";
      } else {
        this.currentDoorState = "geschlossen";
        this.currentDoorStateIcon = "door-closed";
      }
    },
  },
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
