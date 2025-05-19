<template>
    <div>
                    <b-table
                        borderless
                        hover
                        responsive
                        thead-class="d-none"
                        :items="items"
                        :fields="fields"
                    >
                        <template #cell(color)="row">
                            <b-icon
                                icon="square-fill"
                                font-scale="1"
                                :style="'color:#' + row.value"
                            ></b-icon>
                        </template>
                        <template #cell(fillingStatus)="row">
                            <b-progress :value="row.value" :class="{ progressTest: getEmptyState(row.value)}" class="w-10 my2" :variant="getVariantType(row.value)"> <!--w-10 my2 -->
                            </b-progress>
                        </template>
                    </b-table>
        </div>
    </div>
</template>

<script>
export default {
  name: "shaftStatusDetail",
  props: {
    dataObject: {
      type: Array,
      required: true,
    },
    startShaft: {
      type: Number,
      required: true,
    },
  },
  data() {
    return {
      shafts: [],
      fields: [
        { key: "shaft", tdClass: "shaftId" },
        { key: "color", tdClass: "color" },
        { key: "product", tdClass: "product" },
        { key: "missingPackages", tdClass: "missingPackages" },
        { key: "fillingStatus", tdClass: "fillingStatus d-none d-sm-block" },
        { key: "fillingLevel", tdClass: "fillingLevel" },
      ],
      items: [],
      isEmpty: false,
    };
  },
  watch: {
    dataObject(to, from) {
      this.storeReceivedData(this.dataObject);
    },
  },
  methods: {
    storeReceivedData: function (data) {
      this.items = [];
      for (var i = 0, j = this.startShaft - 1; i < 10; i++, j++) {
        var fillingStatusPercent = (data[j].level / data[j].capacity) * 100;
        var amountMissingPackages = data[j].capacity - data[j].level;
        var packageState = data[j].level + "/" + data[j].capacity;
        if (data[j].level == 0) {
          this.isEmpty = true;
        }

        //if (missingPackages == 0) {
        //  missingPackages = "Voll";
        //}

        this.items.push({
          shaft: data[j].shaft_id,
          color: data[j].product.color,
          product: data[j].product.productName,
          missingPackages: "(" + amountMissingPackages + ")",
          fillingStatus: fillingStatusPercent,
          fillingLevel: packageState,
        });
      }
    },
    getEmptyState: function (value) {
      if (value == 0) return "isEmpty";
      else null;
    },

    getVariantType: function (value) {
      if (value > 50) {
        return "success";
      } else if (value > 25) {
        return "warning";
      } else if (value >= 1) {
        return "danger";
      } else {
        return "danger";
      }
    },
  },
};
</script>

<style scoped>
/deep/ .shaftId {
  width: 40px !important;
  text-align: center;
}
/deep/ .color {
  width: 40px !important;
}
/deep/ .product {
  width: 300px !important;
}
/deep/ .fillingStatus {
  width: 200px !important;
}
/deep/ .fillingLevel {
  width: 40px !important;
  text-align: left;
}
/deep/ .missingPackages {
  width: 40px !important;
  text-align: center;
}

.progressTest {
  background-color: #e3342f;
  transition: 2s ease;
}
.progress-label {
  float: left;
  margin-right: 1em;
  font-size: 1em;
}
.card-body {
  padding: 0.5em;
}

/deep/ table {
  margin-bottom: 0px;
}

</style>
