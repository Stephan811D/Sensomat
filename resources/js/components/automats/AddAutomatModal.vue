<template>
  <div>
    <b-modal
      id="modal-add-automat"
      ref="modal-add-automat"
      title="Automat hinzufügen"
      @show="resetModal"
      @hidden="resetModal"
      centered
    >
      <b-img
        height="120"
        class="mb-4 mt-2 modalIcon"
        src="/assets/Icons/Automat_Icon.png"
      ></b-img>

      <hr />

      <form id="addAutomat" ref="form" @submit.stop.prevent="handleSubmit">
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

        <b-form-row>
          <b-col cols="4">
            <label class="col-form-label mb-2">Schächte:</label>
          </b-col>
          <b-col cols="8"
            ><b-form-input
              type="number"
              name="shaftAmount"
              v-model="form.shaftAmount"
              min="1"
              max="20"
          /></b-col>
        </b-form-row>
      </form>

      <template #modal-footer>
        <div class="w-100">
          <b-button
            variant="primary"
            class="float-right"
            type="submit"
            form="addAutomat"
          >
            Hinzufügen
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
        shaftAmount: 1
      }),
    };
  },
  methods: {
    hideModal() {
      this.$refs["modal-add-automat"].hide();
      this.resetModal();
    },
    resetModal() {
      this.form.clear();
      this.form.reset();
    },
    handleSubmit() {
      console.log(this.form);

      this.form
        .post("/api/automat")
        .then(() => {
          this.hideModal();
          this.$emit("updateView");
        })
        .catch((error) => {
          console.log(error);
        }); /*
      axios
        .post("/api/automat/", [], {
          data: this.form
        })
        .then((response) => {
          this.comments = response.data;
          console.log(response.data);
        });*/
      /*
      axios
        .post("/api/automat/", {
          data: this.form,
        })
        .then((response) => {
          this.storeReceivedData(response.data.data);
        })
        .catch(function (error) {
          console.log(error);
        });
*/
    },
  },
};
</script>
<style scoped>
.modalIcon {
  margin: 0 auto;
  display: block;
}
</style>