<template>
  <div>
    <div class="card my-4">
      <div class="card-header">
        <h4 class="navbar-text card-page-titel mb-0">Produkte</h4>
        <ul class="nav nav-pills card-header-pills float-right">
          <li class="nav-item">
            <button
              type="button"
              class="btn btn-primary btn-sm"
              @click="openCreateModal()"
            >
              <span>Hinzufügen</span>
              <svg
                width="1em"
                height="1em"
                viewBox="0 0 16 16"
                class="bi bi-plus-circle"
                fill="currentColor"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  fill-rule="evenodd"
                  d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"
                />
                <path
                  fill-rule="evenodd"
                  d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"
                />
              </svg>
            </button>
          </li>
        </ul>
      </div>
      <div class="card-body">
        <table class="table table-hover" :class="{ loading: loading }">
          <thead>
            <tr>
              <th scope="col" class="text-center">#</th>
              <th scope="col" class="text-center">Farbe</th>
              <th scope="col">Produkt</th>
              <th scope="col" class="d-sm-none d-none d-lg-table-cell">
                Preis
              </th>
              <th scope="col" class="d-sm-none d-none d-lg-table-cell">
                Produktart
              </th>
              <th scope="col" class="d-sm-none d-none d-lg-table-cell">
                Zugewiesen
              </th>
              <th scope="col" class="text-center actionCell">Aktionen</th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="(product, index) in products"
              :key="index"
              :class="{ '-newContent': newContent }"
            >
              <th scope="row" class="align-middle text-center">
                {{ increaseIndex(index) }}
              </th>
              <td scope="row" class="align-middle text-center">
                <span class="d-none">{{ product.color }}</span>
                <svg
                  width="1em"
                  height="1em"
                  viewBox="0 0 16 16"
                  class="bi bi-square-fill"
                  :fill="'#' + product.color"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2z"
                  />
                </svg>
              </td>
              <td class="align-middle">{{ product.productName }}</td>
              <td class="align-middle d-sm-none d-none d-lg-table-cell">
                {{ product.price }}€
              </td>
              <td class="align-middle d-sm-none d-none d-lg-table-cell">
                {{ product.productType }}
              </td>
              <td class="align-middle d-sm-none d-none d-lg-table-cell">
                <a
                  :href="'/automat/' + automats.id"
                  class="badge badge-pill badge-dark mr-1"
                  v-for="(automats, index) in product.automats"
                  :key="index"
                  >{{ automats.automatName }}</a
                >
              </td>
              <td class="align-middle text-right">
                <button
                  type="button"
                  class="btn btn-secondary btn-sm"
                  data-id="product.id"
                  v-on:click="openEditModal(product.id)"
                >
                  <span class="d-none d-xl-inline">Bearbeiten</span>
                  <svg
                    width="1em"
                    height="1em"
                    viewBox="0 0 16 16"
                    class="bi bi-pencil-square"
                    fill="currentColor"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"
                    />
                    <path
                      fill-rule="evenodd"
                      d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"
                    />
                  </svg>
                </button>
                <b-button
                  variant="danger"
                  size="sm"
                  v-on:click="setActiveProductDelete(product.id)"
                  v-b-modal.modal-delete-product
                >
                  <span class="d-none d-xl-inline">Löschen</span>
                  <svg
                    width="1em"
                    height="1em"
                    viewBox="0 0 16 16"
                    class="bi bi-bucket"
                    fill="currentColor"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      fill-rule="evenodd"
                      d="M2.522 5H2a.5.5 0 0 0-.494.574l1.372 9.149A1.5 1.5 0 0 0 4.36 16h7.278a1.5 1.5 0 0 0 1.483-1.277l1.373-9.149A.5.5 0 0 0 14 5h-.522A5.5 5.5 0 0 0 2.522 5zm1.005 0h8.945a4.5 4.5 0 0 0-8.945 0zm9.892 1H2.581l1.286 8.574A.5.5 0 0 0 4.36 15h7.278a.5.5 0 0 0 .494-.426L13.42 6z"
                    />
                  </svg>
                </b-button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div
      class="modal fade"
      id="modalEditProduct"
      tabindex="-1"
      aria-labelledby="modalEditProduct"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Produkt bearbeiten</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <svg
              width="64"
              height="64"
              viewBox="0 0 16 16"
              class="bi bi-bag"
              fill="currentColor"
              xmlns="http://www.w3.org/2000/svg"
              style="display: block; margin: auto"
            >
              <path
                fill-rule="evenodd"
                d="M8 1a2.5 2.5 0 0 0-2.5 2.5V4h5v-.5A2.5 2.5 0 0 0 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5v9a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V5H2z"
              />
            </svg>
            <hr />
            <form method="post" action="machines" id="addBrand">
              <!--@csrf-->
              <div class="form-row mb-2">
                <label for="productName" class="col-4 col-form-label"
                  >Produktname:</label
                >
                <div class="col-8">
                  <input
                    type="text"
                    class="form-control"
                    name="productName"
                    placeholder="Produktname"
                    id="productName"
                  />
                </div>
              </div>
              <div class="form-row mb-2">
                <label for="productName" class="col-4 col-form-label"
                  >Produktart:</label
                >
                <div class="col-8">
                  <select
                    class="form-control"
                    name="productType"
                    placeholder="Produktart"
                    id="productType"
                  >
                    <option
                      v-for="(productType, index) in productTypes"
                      :key="index"
                    >
                      {{ productType.productType }}
                    </option>
                  </select>
                </div>
              </div>
              <div class="form-row mb-2">
                <label for="inputPassword" class="col-4 col-form-label"
                  >Preis:</label
                >
                <div class="col-8">
                  <div class="input-group">
                    <input
                      type="number"
                      class="form-control"
                      name="productPrice"
                      id="productPrice"
                      placeholder="Preis"
                      min="0"
                      max="100"
                      step=".10"
                    />
                    <div class="input-group-append">
                      <span class="input-group-text">€</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-row mb-2">
                <label for="inputPassword" class="col-4 col-form-label"
                  >Farbe:</label
                >
                <div class="col">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text" id="btnGroupAddon">#</div>
                    </div>
                    <input
                      type="text"
                      class="form-control"
                      name="productColor"
                      placeholder="Farbe"
                      id="productColor"
                    />
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <input
                          type="color"
                          id="colorPicker"
                          :value="this.form.color"
                        />
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              Abbrechen
            </button>
            <button
              type="submit"
              class="btn btn-primary"
              value="Create Machine"
              form="addMachine"
            >
              Produkt bearbeiten
            </button>
          </div>
        </div>
      </div>
    </div>

    <div
      class="modal fade"
      id="productModel"
      tabindex="-1"
      role="dialog"
      aria-labelledby="productModelLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 v-show="!editMode" class="modal-title" id="productModelLabel">
              Produkt hinzufügen
            </h5>
            <h5 v-show="editMode" class="modal-title" id="productModelLabel">
              Produkt bearbeiten
            </h5>

            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <svg
              width="64"
              height="64"
              viewBox="0 0 16 16"
              class="bi bi-bag"
              fill="currentColor"
              xmlns="http://www.w3.org/2000/svg"
              style="display: block; margin: auto"
            >
              <path
                fill-rule="evenodd"
                d="M8 1a2.5 2.5 0 0 0-2.5 2.5V4h5v-.5A2.5 2.5 0 0 0 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5v9a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V5H2z"
              />
            </svg>

            <hr />

            <form
              @submit.prevent="editMode ? updateProduct() : createProduct()"
            >
              <input type="hidden" name="_token" :value="csrf" />
              <div class="modal-body">
                <div class="form-row mb-2">
                  <label for="productName" class="col-4 col-form-label"
                    >Produktname:</label
                  >
                  <div class="col-8">
                    <input
                      v-model="form.productName"
                      type="text"
                      class="form-control"
                      name="productName"
                      placeholder="Produktname"
                      :class="{ 'is-invalid': form.errors.has('productName') }"
                    />
                    <has-error :form="form" field="productName"></has-error>
                  </div>
                </div>

                <div class="form-row mb-2">
                  <label for="productType" class="col-4 col-form-label"
                    >Produktart:</label
                  >
                  <div class="col-8">
                    <select
                      v-model="form.productType_id"
                      class="form-control"
                      name="productType"
                    >
                      <option value="" disabled selected>Produktart</option>
                      <option
                        v-for="(productType, index) in productTypes"
                        :key="index"
                        :value="productType.id"
                      >
                        {{ productType.productType }}
                      </option>
                    </select>
                  </div>
                </div>

                <div class="form-row mb-2">
                  <label for="productPrice" class="col-4 col-form-label"
                    >Preis:</label
                  >
                  <div class="col-8">
                    <div class="input-group">
                      <input
                        v-model="form.price"
                        type="number"
                        class="form-control"
                        name="productPrice"
                        placeholder="Preis"
                        min="0"
                        max="100"
                        step=".10"
                      />
                      <div class="input-group-append">
                        <span class="input-group-text">€</span>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-row mb-2">
                  <label for="productColor" class="col-4 col-form-label"
                    >Farbe:</label
                  >
                  <div class="col">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text">#</div>
                      </div>
                      <input
                        v-model="form.color"
                        type="text"
                        class="form-control"
                        name="productColor"
                        placeholder="Farbe"
                      />
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <input
                            type="color"
                            :value="'#' + form.color"
                            @change="setColorCode($event)"
                          />
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-danger"
                  data-dismiss="modal"
                >
                  Abbrechen
                </button>
                <button v-show="editMode" type="submit" class="btn btn-primary">
                  Bearbeiten
                </button>
                <button
                  v-show="!editMode"
                  type="submit"
                  class="btn btn-primary"
                >
                  Hinzufügen
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <deleteProductModal
      :productId="activeProductDelete"
      @updateView="updateView"
    ></deleteProductModal>
  </div>
</template>

<script>
//import { HasError } from 'vform'
//import productEditModal from './Product-Edit.vue';
//import modal from './modal.vue';
//import productRemove from './Product-Remove';

import DeleteProductModal from "./products/DeleteProductModal.vue";

export default {
  name: "products",
  components: {
    DeleteProductModal,
    //modal,
  },
  data: function () {
    return {
      csrf: window.csrfToken,
      products: [],
      productData: [],
      productTypes: [],
      productEditModalVisible: false,
      loading: true,
      isModalVisible: false,
      newContent: true,

      editMode: false,
      form: new Form({
        id: "",
        productName: "",
        productType: "",
        productType_id: "",
        price: "",
        color: "",
      }),

      activeProductDelete: 0,
    };
  },

  mounted() {
    this.loadProducts();
  },

  methods: {
    loadProducts: function () {
      axios
        .get("/api/product")
        .then((response) => {
          this.products = response.data.data;
          console.log("BAUSTELL: ");
          console.log(this.products);
          this.loading = false;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    increaseIndex: function (index) {
      return index + 1;
    },
    loadProduct: function (id) {
      axios
        .get("/api/product/" + id)
        .then((response) => {
          this.form.productName = response.data.data.productName;
          this.form.productType_id = response.data.data.productType_id;
          this.form.price = response.data.data.price;
          this.form.color = response.data.data.color;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    loadProductTypes: function () {
      axios
        .get("/api/productTypes/basic")
        .then((response) => {
          this.productTypes = response.data.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    openEditModal(product) {
      this.loadProductTypes();
      this.editMode = true;
      this.form.clear();
      this.form.reset();
      this.loadProduct(product);
      $("#productModel").modal("show");
      //this.form.fill(product)
      this.form.id = product;
    },
    openCreateModal() {
      this.loadProductTypes();
      this.editMode = false;
      this.form.reset();
      $("#productModel").modal("show");
    },
    setColorCode(e) {
      this.form.color = e.target.value.substring(1);
    },
    updateProduct() {
      this.form
        .put("/api/product/" + this.form.id)
        .then(() => {
          $("#productModel").modal("hide");
          this.loadProducts();
          this.makeSuccessToastUpdate();
        })
        .catch((error) => {
          this.makeFailedToast();
        });
    },
    createProduct() {
      this.form
        .post("api/product")
        .then(() => {
          $("#productModel").modal("hide");
          this.loadProducts();
          this.makeSuccessToastCreate();
        })
        .catch((error) => {
          this.makeFailedToast();
        });
    },
    setActiveProductDelete: function (productId) {
      this.activeProductDelete = productId;
    },
    updateView() {
      this.loadProducts();
    },
    makeSuccessToastUpdate() {
      this.$bvToast.toast("Das Produkt wurde erfolgreich aktualisiert.", {
        title: `Produkt aktualisiert!`,
        variant: "success",
        solid: true,
        autoHideDelay: 2500,
        class: "toast",
      });
    },
    makeSuccessToastCreate() {
      this.$bvToast.toast("Das Produkt wurde erfolgreich hinzugefügt.", {
        title: `Produkt hinzugefügt!`,
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
.-newContent {
  animation: fadeIn ease 2s;
  -webkit-animation: fadeIn ease 2s;
  -moz-animation: fadeIn ease 2s;
  -o-animation: fadeIn ease 2s;
  -ms-animation: fadeIn ease 2s;
}

.close {
  outline: none;
}

.actionCell {
  min-width: 90px;
}

/deep/ .toast {
  top: 50px !important;
  right: 0px !important;
  position: absolute !important;
}

/* XL devices (desktops, 992px and up) */
@media (min-width: 1200px) {
  .actionCell {
    min-width: 210px;
  }
}
</style>
