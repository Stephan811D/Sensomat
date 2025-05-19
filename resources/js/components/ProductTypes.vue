<template>
  <div>
    <div class="my-4">
      <b-row class="p-0 m-0">
        <b-card-group deck>
          <b-col
            v-for="(productType, index) in productTypes"
            :key="index"
            cols="12"
            lg="6"
            xl="4"
            class="p-0 m-0"
          >
            <b-card class="text-center automatCard mb-4">
              <!--<b-img
                height="120"
                class="mb-4 mt-2"
                src="/assets/Icons/Automat_Icon.png"
              ></b-img>-->

              <h4 class="mb-4">{{ productType.productType }}</h4>

              <b-card-text>
                <b-table
                  borderless
                  responsive
                  small
                  thead-class="d-none"
                  :items="productType.items"
                  class="text-left"
                ></b-table>
              </b-card-text>

              <b-row class="p-0 m-0">
                <b-col class="p-1 m-0" cols="6" lg="6" xl="6">
                  <b-button
                    variant="secondary"
                    size="sm"
                    v-on:click="setActiveProductTypeEdit(productType.id)"
                    v-b-modal.modal-edit-productType
                  >
                    <b-icon icon="pencil-square" aria-hidden="true"></b-icon>
                    Bearbeiten
                  </b-button>
                </b-col>
                <b-col class="p-1 m-0" cols="6" lg="6" xl="6">
                  <b-button
                    variant="danger"
                    size="sm"
                    v-on:click="setActiveProductTypeDelete(productType.id)"
                    v-b-modal.modal-delete-productType
                  >
                    <b-icon icon="trash" aria-hidden="true"></b-icon> Löschen
                  </b-button>
                </b-col>
              </b-row>
            </b-card>
          </b-col>
        </b-card-group>
      </b-row>
    </div>
    <b-button
      pill
      variant="primary"
      class="addButton"
      v-b-modal.modal-add-productType
      ><b-icon icon="plus" font-scale="2"></b-icon
    ></b-button>

    <addProductTypeModal @updateView="updateView"></addProductTypeModal>
    <editProductTypeModal
      :productTypeId="activeProductTypeEdit"
      @updateView="updateView"
    ></editProductTypeModal>
    <deleteProductTypeModal
      :productTypeId="activeProductTypeDelete"
      @updateView="updateView"
    ></deleteProductTypeModal>
  </div>
</template>

<script>
import AddProductTypeModal from "./productTypes/AddProductTypeModal.vue";
import EditProductTypeModal from "./productTypes/EditProductTypeModal.vue";
import DeleteProductTypeModal from "./productTypes/DeleteProductTypeModal.vue";

export default {
  name: "dashboard",
  components: {
    AddProductTypeModal,
    EditProductTypeModal,
    DeleteProductTypeModal,
  },
  data() {
    return {
      showLoadingOverlay: false,
      productTypes: [],
      items: [],
      activeProductTypeEdit: 0,
      activeProductTypeDelete: 0,
    };
  },
  mounted() {
    this.getProductTypes();
  },
  methods: {
    getProductTypes: function () {
      axios
        .get("/api/productType") 
        .then((response) => {
          this.storeReceivedData(response.data);
          this.processData();
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    storeReceivedData: function (receivedData) {
      this.productTypes = receivedData;
    },
    processData: function () {
      for (var i = 0; i < this.productTypes.length; i++) {
        var currentProductType = [];
        currentProductType.push({
          name: "Produkttiefe: ",
          value: this.productTypes[i].productDepth / 10 + " mm",
        });
        this.productTypes[i].items = currentProductType;
      }
    },
    setActiveProductTypeEdit: function (productType) {
      this.activeProductTypeEdit = productType;
    },
    setActiveProductTypeDelete: function (productType) {
      this.activeProductTypeDelete = productType;
    },
    updateView: function () {
      this.getProductTypes();
    },
  },
};
</script>

<style scoped>
.automatCard,
img {
  transition: all 0.2s ease-in-out;
}
.automatCard:hover {
  transform: scale(1.015);
}
.automatCard:hover img {
  transform: scale(1.05);
}

@media (max-width: 576px) {
  .card-deck {
    width: 100%;
  }
}

@media (min-width: 1200px) {
  .card-deck {
    width: 100%;
    margin: 0px;
  }
}

.card-deck button {
  width: 100%;
}

.addButton {
  width: 60px;
  height: 60px;
  position: fixed;
  right: 25px;
  bottom: 25px;
  transition: all 0.2s ease-in-out;
}

.addButton:hover {
  transform: scale(1.05);
}
</style>
