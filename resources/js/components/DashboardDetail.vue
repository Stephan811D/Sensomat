<template>
  <div class="my-4">
    <b-overlay :show="showLoadingOverlay" rounded="sm">
      <b-row class="p-0 m-0">
        <b-card-group deck style="width: 110%">
          <b-col cols="12" lg="6" xl="3" class="p-0 m-0">
            <b-card class="widget mb-3">
              <environmentStatus :dataObject="this.environmentData">
              </environmentStatus>
            </b-card>
          </b-col>
          <b-col cols="12" lg="6" xl="3" class="p-0 m-0">
            <b-card class="widget mb-3">
              <fillingStatus :series="this.fillingData"> </fillingStatus>
            </b-card>
          </b-col>
          <b-col cols="12" lg="6" xl="3" class="p-0 m-0">
            <b-card class="widget mb-3">
              <networkStatus :dataObject="this.networkStatusData">
              </networkStatus>
            </b-card>
          </b-col>
          <b-col cols="12" lg="6" xl="3" class="p-0 m-0">
            <b-card class="widget mb-3">
              <doorStatus :dataObject="this.doorStatusData"> </doorStatus>
            </b-card>
          </b-col>
        </b-card-group>
      </b-row>
      <b-row class="p-0 m-0">
        <b-card-group deck class="deck">
          <b-col cols="12" lg="12" xl="6" class="p-0 m-0">
            <b-card class="mb-3">
              <shaftStatusDetail :dataObject="this.shaftsData" :startShaft="1">
              </shaftStatusDetail>
            </b-card>
          </b-col>
          <b-col cols="12" lg="12" xl="6" class="p-0 m-0">
            <b-card class="mb-3">
              <shaftStatusDetail :dataObject="this.shaftsData" :startShaft="11">
              </shaftStatusDetail>
            </b-card>
          </b-col>
        </b-card-group>
      </b-row>
    </b-overlay>
    <!--<b-overlay :show="true" no-wrap></b-overlay>-->
  </div>
</template>

<script>
import EnvironmentStatus from "./widgets/EnvironmentStatus.vue";
import FillingStatus from "./widgets/FillingStatus.vue";
import NetworkStatus from "./widgets/NetworkStatus.vue";
import DoorStatus from "./widgets/DoorStatus";
import ShaftStatusDetail from "./widgets/ShaftStatusDetail.vue";

export default {
  name: "Automat_Dashboard",
  components: {
    EnvironmentStatus,
    FillingStatus,
    NetworkStatus,
    DoorStatus,
    ShaftStatusDetail,
  },
  data() {
    return {
      id: this.$route.params.id,
      showLoadingOverlay: false,
      environmentData: [],
      fillingData: [],
      networkStatusData: [],
      doorStatusData: [],
      shaftsData: [],
      interval: null,
    };
  },
  mounted() {
    this.getData();
    this.interval = setInterval(
      function () {
        this.getData();
      }.bind(this),
      10000
    );
  },
  //computed() {
  //    this.id = this.$route.params.id;
  //},
  watch: {
    $route(to, from) {
      this.id = to.params.id;
      this.getData();
    },
  },
  methods: {
    componentLoaded: function (component) {
      this.showLoadingOverlay = false;
    },
    getData: function () {
      axios
        .get("/api/automat/" + this.id)
        .then((response) => {
          this.storeReceivedData(response.data.data);
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    storeReceivedData: function (data) {
      this.environmentData = data.environmentStatus;
      this.fillingData = [data.fillingStatus];
      this.networkStatusData = data.networkStatus;
      this.doorStatusData = data.doorStatus;
      this.shaftsData = data.shafts;
    },
  },
  beforeDestroy: function () {
    clearInterval(this.interval);
  },
};
</script>

<style scoped>
.card-body {
  height: 100%;
}
/deep/ .widget {
  height: 275px;
  overflow: hidden;
}

.deck {
  width: 100%;
}

@media (min-width: 576px) {
  .deck {
    width: 110%;
  }
}
</style>
