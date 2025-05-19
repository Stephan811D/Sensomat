<template>
  <div>
    <b-modal
      id="modal-delete-product"
      ref="modal-delete-product"
      title="Produktart löschen"
      centered
    >
      <!--<b-img
        height="120"
        class="mb-4 mt-2 modalIcon"
        src="/assets/Icons/Automat_Icon.png"
      ></b-img>-->

      <h5 class="text-center">{{ productName }}</h5>

      <hr />

      <form id="deleteProduct" ref="form" @submit.stop.prevent="handleSubmit">
        <h5 class="text-center mt-4">
          Soll das Produkt wirklich gelöscht werden?
        </h5>
      </form>

      <template #modal-footer>
        <div class="w-100">
          <b-button
            variant="danger"
            class="float-right"
            type="submit"
            form="deleteProduct"
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
    productId: {
      type: Number,
      default: 0,
    },
  },
  data() {
    return {
      productName: "",
    };
  },
  watch: {
    productId: function (val) {
      this.getProduct();
    },
  },
  methods: {
    hideModal() {
      this.$refs["modal-delete-product"].hide();
    },
    handleSubmit() {
      axios
        .delete("/api/product/" + this.productId, {})
        .then(() => {
          this.makeSuccessToast();
          this.$emit("updateView");
        })
        .catch((error) => {
          if (error.response.status === 409) {
            this.makeFailedToast('Das Produkt ist einem aktiven Automaten zugewiesen!');
          } else {
            this.makeFailedToast(error);
          }
        });
      this.hideModal();
    },
    getProduct() {
      axios
        .get("/api/product/" + this.productId)
        .then((response) => {
          this.storeReceivedData(response.data);
        })
        .catch((error) => {
          this.makeFailedToast(error);
        });
    },
    storeReceivedData(data) {
      this.productName = data.data.productName;
    },
    makeSuccessToast() {
      this.$bvToast.toast("Das Produkt wurde erfolgreich gelöscht.", {
        title: `Produkt gelöscht!`,
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