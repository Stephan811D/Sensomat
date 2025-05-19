<template>
  <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap shadow">
    <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3 mr-auto" href="#">
      <img
        class="mb-4 logo"
        src="/assets/Sensomat_Logo_White.png"
        alt=""
        width="25"
        height="25"
      />
      <span>Sensomat</span>
    </a>
    <div>
      <b-button
        v-b-toggle.collapse-3
        class="m-1 navbar-toggler position-absolute d-md-none toggleButton"
        ><span class="navbar-toggler-icon"></span
      ></b-button>
      <b-collapse invisible id="collapse-3">
        <menuComponent></menuComponent>
      </b-collapse>
    </div>

    <svg
      width="1em"
      height="1em"
      viewBox="0 0 16 16"
      class="bi bi-person-square text-light mr-2 d-none d-md-block"
      fill="currentColor"
      xmlns="http://www.w3.org/2000/svg"
    >
      <path
        d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 0 0 8 15a6.987 6.987 0 0 0 5.468-2.63z"
      />
      <path fill-rule="evenodd" d="M8 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
      <path
        fill-rule="evenodd"
        d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zM0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8z"
      />
    </svg>

    <span class="navbar-text mr-3 text-light d-none d-md-block">
      {{ user.name }}
    </span>
    <button
      class="btn btn-outline-light btn-sm d-none d-md-block"
      type="button"
      @click="logout()"
    >
      Logout
    </button>
  </nav>
</template>

<script>
import MenuComponent from "./Menu.vue";

export default {
  components: {
    MenuComponent,
  },
  data() {
    return {
      user: [],
    };
  },
  mounted() {
    axios.get("/api/user").then((response) => {
      this.user = response.data;
    });
  },
  methods: {
    logout: function () {
      axios.post("/api/logout").then((response) => {
        this.$router.push({
          name: "Login",
        });
      });
    },
  },
};
</script>
<style scoped>
.logo {
  transform: translateX(-10px);
  margin-bottom: 0px !important;
}
.toggleButton {
  position: absolute !important;
  right: 12px;
  top: 5px;
}
</style>