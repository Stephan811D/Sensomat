<template>
  <div>
    <b-modal
      id="modal-delete-productType"
      ref="modal-delete-productType"
      title="Produktart löschen"
      centered
    >
      <!--<b-img
        height="120"
        class="mb-4 mt-2 modalIcon"
        src="/assets/Icons/Automat_Icon.png"
      ></b-img>-->

      <h5 class="text-center">{{ productType }}</h5>

      <hr />

      <form id="deleteAutomat" ref="form" @submit.stop.prevent="handleSubmit">
        <h5 class="text-center mt-4">
          Soll die Produktart wirklich gelöscht werden?
        </h5>
      </form>

      <template #modal-footer>
        <div class="w-100">
          <b-button
            variant="danger"
            class="float-right"
            type="submit"
            form="deleteAutomat"
          >
            Löschen
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
    productTypeId: {
      type: Number,
      default: 0,
    },
  },
  data() {
    return {
      productType: "",
    };
  },
  watch: {
    productTypeId: function (val) {
      this.getProductType();
      console.log(val);
    },
  },
  methods: {
    hideModal() {
      this.$refs["modal-delete-productType"].hide();
    },
    handleSubmit() {
      axios
        .delete("/api/productType/" + this.productTypeId, {})
        .then(() => {
          this.makeSuccessToast();
          this.$emit("updateView");
        })
        .catch(function (error) {
          this.makeFailedToast(error);
        });
        this.hideModal();
    },
    getProductType() {
      axios
        .get("/api/productType/" + this.productTypeId)
        .then((response) => {
          this.storeReceivedData(response.data);
        })
        .catch((error) => {
          this.makeFailedToast(error);
        });
    },
    storeReceivedData(data) {
      this.productType = data.productType;
    },
    makeSuccessToast() {
      this.$bvToast.toast("Die Produktart wurde erfolgreich gelöscht.", {
        title: `Produktart gelöscht!`,
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