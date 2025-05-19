<template>
  <div>
    <div class="my-4">
      <b-row class="p-0 m-0">
        <b-card-group deck class="deck">
          <b-col
            v-for="(automat, index) in automats"
            :key="index"
            cols="12"
            lg="6"
            xl="4"
            class="p-0 m-0"
          >
            <b-card class="text-center fillingCard mb-4">
              <h4 class="my-1">{{ automat.automatName }}</h4>

              <fillingStatus :series="[automat.fillingStatus]"> </fillingStatus>
              <router-link
                class="nav-link text-light"
                :to="/dashboard/ + automat.id"
              >
                <b-button variant="primary">Detailansicht</b-button>
              </router-link>
            </b-card>
          </b-col>
        </b-card-group>
      </b-row>
      <!--<b-overlay :show="true" no-wrap></b-overlay>-->
    </div>
  </div>
</template>

<script>
import FillingStatus from "./widgets/FillingStatus.vue";

export default {
  name: "dashboard",
  components: {
    FillingStatus,
  },
  data() {
    return {
      showLoadingOverlay: false,
      automats: [],
    };
  },
  mounted() {
    this.getAutomats();
  },
  methods: {
    getAutomats: function () {
      axios
        .get("/api/automats/status")
        .then((response) => {
          this.storeReceivedData(response.data.data);
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    storeReceivedData: function (receivedData) {
      this.automats = receivedData;
    },
  },
};
</script>
<style scoped>
.fillingCard {
  transition: all 0.2s ease-in-out;
}
.fillingCard:hover {
  transform: scale(1.015);
}
.deck {
  width: 100%;
}

@media (min-width: 576px) {
  .deck {
    width: 110%;
  }
}

@media (min-width: 768px) {
  .deck {
    width: 105%;
  }
}
@media (min-width: 992px) {
  .deck {
    width: 110%;
  }
}
</style>

