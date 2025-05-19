<template>
  <div>
    <b-modal
      id="modal-edit-automat-shafts"
      ref="modal-edit-automat-shafts"
      title="Schächte bearbeiten"
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

      <form id="editShafts" ref="form" @submit.stop.prevent="handleSubmit">
        <b-row>
          <b-col cols="12" lg="6">
            <b-form-group
              label-cols="2"
              content-cols="10"
              label-cols-sm="3"
              content-cols-sm="9"
              :label="`Schacht ${index + 1}:`"
              :label-for="`shaft-${shaft.item}`"
              v-for="(shaft, index) in shafts.slice(0, 10)"
              :key="index"
              class="mb-0"
            >
              <b-form-select
                :id="`shaft-${shaft.item}`"
                v-model="shaft.name"
                :options="options"
                class="mb-3"
                value-field="item"
                text-field="name"
                size="sm"
              ></b-form-select>
            </b-form-group>
          </b-col>
          <b-col cols="12" lg="6">
            <b-form-group
              label-cols="2"
              content-cols="10"
              label-cols-sm="3"
              content-cols-sm="9"
              :label="`Schacht ${index + 11}:`"
              :label-for="`shaft-${shaft.item}`"
              v-for="(shaft, index) in shafts.slice(10, 20)"
              :key="index"
              class="mb-0"
            >
              <b-form-select
                :id="`shaft-${shaft.item}`"
                v-model="shaft.name"
                :options="options"
                class="mb-3"
                value-field="item"
                text-field="name"
                size="sm"
              ></b-form-select>
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
            form="editShafts"
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
      options: [],
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
      this.$refs["modal-edit-automat-shafts"].hide();
    },
    handleSubmit() {
      this.createUpdateObject();
      if (this.dataForRequest.length != 0) {
        axios
          .post("/api/automat/shafts", {
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
      this.options = [];
      this.lastShaftsState = [];
      this.automatName = data.automatName;
      for (var i = 0; i < data.products.length; i++) {
        this.options.push({
          item: data.products[i].id,
          name: data.products[i].productName,
        });
      }
      for (var i = 0; i < data.shafts.length; i++) {
        this.shafts.push({
          item: data.shafts[i].id,
          name: data.shafts[i].product_id,
        });
        this.lastShaftsState.push({
          item: data.shafts[i].id,
          name: data.shafts[i].product_id,
        });
      }
    },
    createUpdateObject() {
      this.dataForRequest = {};
      var updatedShafts = [];
      for (let i = 0; i < this.shafts.length; i++) {
        if (this.shafts[i].name != this.lastShaftsState[i].name) {
          var currentShaft = {
            shaft_id: this.shafts[i].item,
            product_id: this.shafts[i].name,
          };
          this.lastShaftsState[i].name = this.shafts[i].name;
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
/deep/ .toast {
  top: 50px !important;
  right: 0px !important;
  position: absolute !important;
}
</style>