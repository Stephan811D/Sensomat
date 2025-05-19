<template>
  <div>
    <b-modal
      id="modal-add-productType"
      ref="modal-add-productType"
      title="Produktart hinzufügen"
      centered
    >
      <!--<b-img
        height="120"
        class="mb-4 mt-2 modalIcon"
        src="/assets/Icons/Automat_Icon.png"
      ></b-img>

      <hr />-->

      <form id="addProductType" ref="form" @submit.stop.prevent="handleSubmit">
        <b-form-row>
          <b-col cols="4">
            <label class="col-form-label mb-2">Produktart:</label>
          </b-col>
          <b-col cols="8"
            ><b-form-input
              placeholder="Produktart"
              type="text"
              name="productType"
              v-model="form.productType"
          /></b-col>
        </b-form-row>

        <b-form-row>
          <b-col cols="4">
            <label class="col-form-label mb-2">Produkttiefe:</label>
          </b-col>
          <b-col cols="8">
            <b-input-group append="mm" class="mb-2 mr-sm-2 mb-sm-0">
              <b-form-input
                placeholder="Produkttiefe"
                type="number"
                name="productDepth"
                v-model="form.productDepth"
                min="0"
                max="1000"
                step="0.1"
              />
            </b-input-group>
          </b-col>
        </b-form-row>
      </form>

      <template #modal-footer>
        <div class="w-100">
          <b-button
            variant="primary"
            class="float-right"
            type="submit"
            form="addProductType"
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
        productType: "",
        productDepth: 0,
      }),
    };
  },
  methods: {
    hideModal() {
      this.$refs["modal-add-productType"].hide();
      this.resetModal();
    },
    resetModal() {
      this.form.clear();
      this.form.reset();
    },
    handleSubmit() {
      this.form.productDepth = this.form.productDepth * 10;
      this.form
        .post("/api/productType")
        .then(() => {
          this.hideModal();
          this.makeSuccessToast();
          this.$emit("updateView");
        })
        .catch((error) => {
          this.makeFailedToast();
        });
    },
    makeSuccessToast() {
      this.$bvToast.toast("Die Produktart wurde erfolgreich hinzugefügt.", {
        title: `Produktart hinzugefügt!`,
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