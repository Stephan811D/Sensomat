<template>
  <div>
    <div class="my-4">
      <b-row class="p-0 m-0">
        <b-card-group deck>
          <b-col
            v-for="(automat, index) in automats"
            :key="index"
            cols="12"
            lg="6"
            xl="4"
            class="p-0 m-0"
          >
            <b-card class="text-center automatCard mb-4">
              <b-img
                height="120"
                class="mb-4 mt-2"
                src="/assets/Icons/Automat_Icon.png"
              ></b-img>

              <h4 class="mb-4">{{ automat.automatName }}</h4>

              <b-card-text>
                <b-table
                  borderless
                  responsive
                  small
                  thead-class="d-none"
                  :items="automat.items"
                  class="text-left"
                ></b-table>
              </b-card-text>

              <b-row class="p-0 m-0">
                <b-col class="p-1 m-0" cols="6" lg="6" xl="6">
                  <b-button
                    variant="secondary"
                    size="sm"
                    v-on:click="setActiveAutomatEdit(automat.id)"
                    v-b-modal.modal-edit-automat
                  >
                    <b-icon icon="pencil-square" aria-hidden="true"></b-icon>
                    Bearbeiten
                  </b-button>
                </b-col>
                <b-col class="p-1 m-0" cols="6" lg="6" xl="6">
                  <b-button
                    variant="secondary"
                    size="sm"
                    v-on:click="setActiveAutomatConfig(automat.id)"
                    v-b-modal.modal-configure-automat-shafts
                  >
                    <b-icon icon="wrench" aria-hidden="true"></b-icon>
                    Konfigurieren
                  </b-button>
                </b-col>
              </b-row>
              <b-row class="p-0 m-0">
                <b-col class="p-1 m-0" cols="6" lg="6" xl="6">
                  <b-button
                    variant="secondary"
                    size="sm"
                    v-on:click="setActiveAutomatShaftEdit(automat.id)"
                    v-b-modal.modal-edit-automat-shafts
                  >
                    <b-icon
                      icon="arrow-down-square"
                      aria-hidden="true"
                    ></b-icon>
                    Zuweisen
                  </b-button>
                </b-col>

                <b-col class="p-1 m-0" cols="6" lg="6" xl="6">
                  <b-button
                    variant="danger"
                    size="sm"
                    v-on:click="setActiveAutomatDelete(automat.id)"
                    v-b-modal.modal-delete-automat
                  >
                    <b-icon icon="trash" aria-hidden="true"></b-icon> Löschen
                  </b-button>
                </b-col></b-row
              >
            </b-card>
          </b-col>
        </b-card-group>
      </b-row>
    </div>
    <b-button
      pill
      variant="primary"
      class="addButton"
      v-b-modal.modal-add-automat
      ><b-icon icon="plus" font-scale="2"></b-icon
    ></b-button>

    <addAutomatModal @updateView="updateView"></addAutomatModal>
    <editAutomatModal
      :automatId="activeAutomatEdit"
      @updateView="updateView"
    ></editAutomatModal>
    <editAutomatShaftsModal
      :automatId="activeAutomatShaftEdit"
    ></editAutomatShaftsModal>
    <configureAutomatShaftsModal
      :automatId="activeAutomatConfig"
    ></configureAutomatShaftsModal>
    <delete-automat-modal
      :automatId="activeAutomatDelete"
      @updateView="updateView"
    ></delete-automat-modal>
  </div>
</template>

<script>
import FillingStatus from "./widgets/FillingStatus.vue";
import AddAutomatModal from "./automats/AddAutomatModal.vue";
import EditAutomatModal from "./automats/EditAutomatModal.vue";
import EditAutomatShaftsModal from "./automats/EditAutomatShaftsModal.vue";
import ConfigureAutomatShaftsModal from "./automats/ConfigureAutomatShaftsModal.vue";
import DeleteAutomatModal from "./automats/DeleteAutomatModal.vue";

export default {
  name: "automats",
  components: {
    FillingStatus,
    AddAutomatModal,
    EditAutomatModal,
    EditAutomatShaftsModal,
    ConfigureAutomatShaftsModal,
    DeleteAutomatModal,
  },
  data() {
    return {
      showLoadingOverlay: false,
      automats: [],
      items: [],
      activeAutomatEdit: 0,
      activeAutomatShaftEdit: 0,
      activeAutomatConfig: 0,
      activeAutomatDelete: 0,
    };
  },
  mounted() {
    this.getAutomats();
  },
  methods: {
    getAutomats: function () {
      axios
        .get("/api/automats/basic")
        .then((response) => {
          this.storeReceivedData(response.data.data);
          this.processData();
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    storeReceivedData: function (receivedData) {
      this.automats = receivedData;
    },
    processData: function () {
      for (var i = 0; i < this.automats.length; i++) {
        var currentAutomat = [];
        currentAutomat.push({
          name: "Automat-ID:",
          value: this.automats[i].automatId,
        });
        currentAutomat.push({
          name: "Straße: ",
          value:
            this.automats[i].addressLine1 + " " + this.automats[i].addressLine2,
        });
        currentAutomat.push({
          name: "Stadt: ",
          value: this.automats[i].zipCode + " " + this.automats[i].city,
        });
        currentAutomat.push({
          name: "Region: ",
          value: this.automats[i].region,
        });
        currentAutomat.push({
          name: "Land: ",
          value: this.automats[i].country,
        });
        this.automats[i].items = currentAutomat;
      }
    },
    setActiveAutomatEdit: function (automatId) {
      this.activeAutomatEdit = automatId;
    },
    setActiveAutomatShaftEdit: function (automatId) {
      this.activeAutomatShaftEdit = automatId;
    },
    setActiveAutomatConfig: function (automatId) {
      this.activeAutomatConfig = automatId;
    },
    setActiveAutomatDelete: function (automatId) {
      this.activeAutomatDelete = automatId;
    },
    updateView: function () {
      this.getAutomats();
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
