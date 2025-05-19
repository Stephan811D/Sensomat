<template>
  <div>
    <b-modal
      id="modal-edit-automat"
      ref="modal-edit-automat"
      title="Automat bearbeiten"
      centered
    >
      <b-img
        height="120"
        class="mb-4 mt-2 modalIcon"
        src="/assets/Icons/Automat_Icon.png"
      ></b-img>

      <hr />

      <form id="editAutomat" ref="form" @submit.stop.prevent="handleSubmit">
        <b-form-row>
          <b-col cols="4">
            <label class="col-form-label mb-2">Automat-Name:</label>
          </b-col>
          <b-col cols="8"
            ><b-form-input
              placeholder="Automat-Name"
              type="text"
              name="automatName"
              v-model="form.automatName"
          /></b-col>
        </b-form-row>

        <b-form-row>
          <b-col cols="4">
            <label class="col-form-label mb-2">Automat-ID:</label>
          </b-col>
          <b-col cols="8"
            ><b-form-input
              placeholder="Automat-ID"
              type="text"
              name="automatId"
              v-model="form.automatId"
          /></b-col>
        </b-form-row>

        <b-form-row>
          <b-col cols="4">
            <label class="col-form-label mb-2">Adresse:</label>
          </b-col>
          <b-col cols="5"
            ><b-form-input
              placeholder="Straße"
              type="text"
              name="addressLine1"
              v-model="form.addressLine1"
          /></b-col>
          <b-col cols="3"
            ><b-form-input
              placeholder="Hausnr."
              type="text"
              name="addressLine2"
              v-model="form.addressLine2"
          /></b-col>
        </b-form-row>

        <b-form-row class="justify-content-end mb-2">
          <b-col cols="3"
            ><b-form-input
              placeholder="PLZ"
              type="text"
              name="zipCode"
              v-model="form.zipCode"
          /></b-col>
          <b-col cols="5"
            ><b-form-input
              placeholder="Stadt"
              type="text"
              name="city"
              v-model="form.city"
          /></b-col>
        </b-form-row>

        <b-form-row class="justify-content-end mb-2">
          <b-col cols="4"
            ><b-form-input
              placeholder="Region"
              type="text"
              name="region"
              v-model="form.region"
          /></b-col>
          <b-col cols="4"
            ><b-form-input
              placeholder="Land"
              type="text"
              name="country"
              v-model="form.country"
          /></b-col>
        </b-form-row>
      </form>

      <template #modal-footer>
        <div class="w-100">
          <b-button
            variant="primary"
            class="float-right"
            type="submit"
            form="editAutomat"
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
      form: new Form({
        automatName: "",
        automatId: "",
        addressLine1: "",
        addressLine2: "",
        zipCode: "",
        city: "",
        region: "",
        country: "",
      }),
      lastAutomatState: new Form({
        automatName: "",
        automatId: "",
        addressLine1: "",
        addressLine2: "",
        zipCode: "",
        city: "",
        region: "",
        country: "",
      }),
    };
  },
  watch: {
    automatId: function (val) {
      this.getDetailedAutomatData();
    },
  },
  methods: {
    hideModal() {
      this.$refs["modal-edit-automat"].hide();
    },
    handleSubmit() {
      if (
        !_.isEqual(
          JSON.stringify(this.form),
          JSON.stringify(this.lastAutomatState)
        )
      ) {
        this.form
          .put("/api/automat/" + this.automatId)
          .then(() => {
            this.makeSuccessToast();
            this.$emit("updateView");
          })
          .catch((error) => {
            this.makeFailedToast(error);
          });
      }
      this.hideModal();
    },
    getDetailedAutomatData() {
      axios
        .get("/api/automat/basic/" + this.automatId)
        .then((response) => {
          this.storeReceivedData(response.data.data);
        })
        .catch((error) => {
          this.makeFailedToast(error);
        });
    },
    storeReceivedData(data) {
      this.form.clear();
      this.form.automatName = data.automatName;
      this.form.automatId = data.automatId;
      this.form.addressLine1 = data.addressLine1;
      this.form.addressLine2 = data.addressLine2;
      this.form.zipCode = data.zipCode;
      this.form.city = data.city;
      this.form.region = data.region;
      this.form.country = data.country;

      this.lastAutomatState.clear();
      this.lastAutomatState.automatName = data.automatName;
      this.lastAutomatState.automatId = data.automatId;
      this.lastAutomatState.addressLine1 = data.addressLine1;
      this.lastAutomatState.addressLine2 = data.addressLine2;
      this.lastAutomatState.zipCode = data.zipCode;
      this.lastAutomatState.city = data.city;
      this.lastAutomatState.region = data.region;
      this.lastAutomatState.country = data.country;
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
        title: `Es gab ein Problem!`,
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