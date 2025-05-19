<template>
    <div>
        <div style="">
            <div class="content-center">
                <div class="text-center">
                    <b-icon
                        :icon="this.signalStrengthIcon"
                        font-scale="3"
                    ></b-icon>
                    <h5 class="mt-4">{{ this.dataObject.SSID }}</h5>
                </div>
            </div>
        </div>
        <b-table
            borderless
            responsive
            thead-class="d-none"
            small
            :items="items"
            class="mt-4"
        >
            <template #cell(value)="data">
                <div v-html="data.value"></div>
            </template>
        </b-table>
    </div>
</template>

<script>
export default {
    name: "networkStatus",
    props: {
        dataObject: {
            type: Object,
            required: true
        }
    },
    data: () => ({
        signalStrengthIcon: null,
        items: [],
    }),
    watch: {
        dataObject(to, from) {
            this.signalStrengthIcon = this.checkSignalStrength(
                this.dataObject.signalStrength
            );
            this.items = [];
            this.items.push({
                name: "Status:",
                value: this.checkOnlineStatus(this.dataObject.onlineStatus)
            });
            this.items.push({
                name: "IP-Adresse:",
                value: this.dataObject.ipAddress
            });
            this.items.push({
                name: "Letzter Zugriff:",
                value: this.dataObject.lastAccess
            });
        }
    },
    methods: {
        checkOnlineStatus: function(onlineStatus) {
            if (onlineStatus == true) {
                return "<span style='color:green'>online</span>";
            } else {
                return "<span style='color:#e3342f'>offline</span>";
            }
        },
        checkSignalStrength: function(signalStrength) {
            if (
                signalStrength <= 0 &&
                signalStrength > -80 &&
                this.dataObject.onlineStatus
            ) {
                return "wifi";
            } else if (
                signalStrength <= -80 &&
                signalStrength > -85 &&
                this.dataObject.onlineStatus
            ) {
                return "wifi2";
            } else if (
                signalStrength <= -85 &&
                signalStrength >= -90 &&
                this.dataObject.onlineStatus
            ) {
                return "wifi1";
            } else {
                return "wifi-off";
            }
        }
    }
};
</script>

<style scoped>
.card-body {
    height: 100%;
}
</style>
