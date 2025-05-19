<template>
  <div>
    <b-modal
      id="modal-configure-automat-shafts"
      ref="modal-configure-automat-shafts"
      title="Schächte konfigurieren"
      centered
      size="xl"
    >
      <b-img
        height="120"
        class="mb-4 mt-2 modalIcon"
        src="/assets/Icons/Automat_Icon.png"
      ></b-img>

      <h5 class="text-center">{{ automatName }}</h5>

      <hr />

      <b-row>
        <b-col cols="12" lg="6" class="d-none d-lg-block">
          <h5 class="text-center">Schachtlänge</h5>
          <hr />
        </b-col>
        <b-col cols="12" lg="6" class="d-none d-lg-block">
          <h5 class="text-center">Schachtkapazität</h5>
          <hr />
        </b-col>
      </b-row>

      <form id="configureShafts" ref="form" @submit.stop.prevent="handleSubmit">
        <b-row>
          <b-col cols="12" class="d-block d-lg-none">
            <h5 class="text-center">Schachtlänge</h5>
            <hr />
          </b-col>
          <b-col cols="12" lg="3">
            <b-form-group
              label-cols="6"
              content-cols="6"
              label-cols-xl="5"
              content-cols-xl="7"
              :label="`Schacht ${index + 1}:`"
              :label-for="`shaft-${shaft.item}`"
              v-for="(shaft, index) in shafts.slice(0, 10)"
              :key="index"
              class="mb-0"
            >
              <b-input-group size="sm" append="mm" is-text>
                <b-form-input
                  :id="`shaft-${shaft.item}`"
                  v-model="shaft.measuredShaftLength"
                  class="text-center"
                  value-field="measuredShaftLength"
                  text-field="measuredShaftLength"
                  type="number"
                  min="0"
                  max="2500"
                ></b-form-input>
              </b-input-group>
            </b-form-group>
          </b-col>
          <b-col cols="12" lg="3">
            <b-form-group
              label-cols="6"
              content-cols="6"
              label-cols-xl="5"
              content-cols-xl="7"
              :label="`Schacht ${index + 11}:`"
              :label-for="`shaft-${shaft.item}`"
              v-for="(shaft, index) in shafts.slice(10, 20)"
              :key="index"
              class="mb-0"
            >
              <b-input-group size="sm" append="mm" is-text>
                <b-form-input
                  :id="`shaft-${shaft.item}`"
                  v-model="shaft.measuredShaftLength"
                  class="text-center"
                  value-field="measuredShaftLength"
                  text-field="measuredShaftLength"
                  type="number"
                  min="0"
                  max="2500"
                ></b-form-input>
              </b-input-group>
            </b-form-group>
          </b-col>
          <b-col cols="12" class="d-block d-lg-none mt-4">
            <h5 class="text-center">Schachtkapazität</h5>
            <hr />
          </b-col>
          <b-col cols="12" lg="3">
            <b-form-group
              label-cols="6"
              content-cols="6"
              label-cols-xl="5"
              content-cols-xl="7"
              :label="`Schacht ${index + 1}:`"
              :label-for="`shaft-${shaft.item}`"
              v-for="(shaft, index) in shafts.slice(0, 10)"
              :key="index"
              class="mb-0"
            >
              <b-input-group size="sm" append="Pkg." is-text>
                <b-form-input
                  :id="`shaft-${shaft.item}`"
                  v-model="shaft.capacity"
                  class="text-center"
                  value-field="capacity"
                  text-field="capacity"
                  type="number"
                  min="0"
                  max="100"
                ></b-form-input>
              </b-input-group>
            </b-form-group>
          </b-col>
          <b-col cols="12" lg="3">
            <b-form-group
              label-cols="6"
              content-cols="6"
              label-cols-xl="5"
              content-cols-xl="7"
              :label="`Schacht ${index + 11}:`"
              :label-for="`shaft-${shaft.item}`"
              v-for="(shaft, index) in shafts.slice(10, 20)"
              :key="index"
              class="mb-0"
            >
              <b-input-group size="sm" append="Pkg." is-text>
                <b-form-input
                  :id="`shaft-${shaft.item}`"
                  v-model="shaft.capacity"
                  class="text-center"
                  value-field="capacity"
                  text-field="capacity"
                  type="number"
                  min="0"
                  max="100"
                ></b-form-input>
              </b-input-group>
            </b-form-group>
          </b-col>
        </b-row>
      </form>

      <template #modal-footer>
        <div class="w-100">
          <b-button
            variant="primary"
            class="float-right"
            type="submit"
            form="configureShafts"
          >
            Bearbeiten
          </b-button>
          <b-button
            variant="secondary"
            class="float-right mr-2"
            @click="hideModal"
          >
            Abbrechen
          </b-button>
        </div>
      </template>
    </b-modal>
  </div>
</template>
<script>
export default {
  props: {
    automatId: {
      type: Number,
      default: 0,
    },
  },
  data() {
    return {
      automatName: null,
      shafts: [],
      lastShaftsState: [],
      dataForRequest: {},
    };
  },
  created() {
    //this.getDetailedAutomatData();
  },
  watch: {
    automatId: function (val) {
      this.getDetailedAutomatData();
    },
  },
  methods: {
    hideModal() {
      this.$refs["modal-configure-automat-shafts"].hide();
    },
    handleSubmit() {
      this.createUpdateObject();
      if (this.dataForRequest.length != 0) {
        axios
          .post("/api/automat/shafts/config", {
            data: this.dataForRequest,
          })
          .then(() => {
            this.makeSuccessToast();
          })
          .catch(function (error) {
            this.makeFailedToast(error);
          });
      }
      this.hideModal();
    },
    getDetailedAutomatData() {
      axios
        .get("/api/automat/shafts/" + this.automatId)
        .then((response) => {
          this.storeReceivedData(response.data.data);
        })
        .catch(function (error) {
          this.makeFailedToast(error);
        });
    },
    storeReceivedData(data) {
      this.shafts = [];
      this.lastShaftsState = [];
      this.automatName = data.automatName;
      for (var i = 0; i < data.shafts.length; i++) {
        this.shafts.push({
          item: data.shafts[i].id,
          measuredShaftLength: data.shafts[i].measuredShaftLength,
          capacity: data.shafts[i].capacity,
        });
        this.lastShaftsState.push({
          item: data.shafts[i].id,
          measuredShaftLength: data.shafts[i].measuredShaftLength,
          capacity: data.shafts[i].capacity,
        });
      }
    },
    createUpdateObject() {
      this.dataForRequest = {};
      var updatedShafts = [];
      for (let i = 0; i < this.shafts.length; i++) {
        if (
          this.shafts[i].measuredShaftLength !=
          this.lastShaftsState[i].measuredShaftLength
        ) {
          var currentShaft = {
            shaft_id: this.shafts[i].item,
            measuredShaftLength: this.shafts[i].measuredShaftLength,
          };
          this.lastShaftsState[i].measuredShaftLength = this.shafts[i].measuredShaftLength;
          updatedShafts.push(currentShaft);
        }
        if (this.shafts[i].capacity != this.lastShaftsState[i].capacity) {
          var currentShaft = {
            shaft_id: this.shafts[i].item,
            capacity: this.shafts[i].capacity,
          };
          this.lastShaftsState[i].capacity = this.shafts[i].capacity;
          updatedShafts.push(currentShaft);
        }
      }
      this.dataForRequest = updatedShafts;
    },
    makeSuccessToast() {
      this.$bvToast.toast("Der Automat wurde erfolgreich aktualisiert.", {
        title: `Automat aktualisiert!`,
        variant: "success",
        solid: true,
        autoHideDelay: 2500,
        class: "toast",
      });
    },
    makeFailedToast(error) {
      this.$bvToast.toast("Folgender Fehler ist aufgetreten: " + error, {
        title: `Es gab eine Problem!`,
        variant: "danger",
        solid: true,
      });
    },
  },
};
</script>
<style scoped>
.modalIcon {
  margin: 0 auto;
  display: block;
}
@media (min-width: 992px) and (max-width: 1199.98px) {
  /deep/ .modal-xl {
    max-width: 950px !important;
  }
}
/deep/ .toast {
  top: 50px !important;
  right: 0px !important;
  position: absolute !important;
}
</style>