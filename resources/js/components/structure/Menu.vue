<template>
  <div>
    <ul class="nav flex-column nav-pills p-2">
      <li class="nav-item">
        <router-link class="nav-link text-light" to="/dashboard">
          <svg
            width="1.5em"
            height="1em"
            viewBox="0 0 16 16"
            class="bi bi-bar-chart-line"
            fill="currentColor"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              fill-rule="evenodd"
              d="M11 2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h1V7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7h1V2zm1 12h2V2h-2v12zm-3 0V7H7v7h2zm-5 0v-3H2v3h2z"
            />
          </svg>
          <span class="align-bottom pl-1">Dashboard</span>
        </router-link>
      </li>
      <li class="nav-item">
        <router-link
          v-for="automat in automats"
          :key="automat.id"
          :to="'/dashboard/' + automat.id"
          class="nav-link text-light"
        >
          <div style="font-size: 1em; display: inline-block" class="pl-2">
            <svg
              width="1.5em"
              height="1em"
              viewBox="0 0 16 16"
              class="bi bi-bar-chart-line"
              fill="currentColor"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                fill-rule="evenodd"
                d="M11 2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h1V7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7h1V2zm1 12h2V2h-2v12zm-3 0V7H7v7h2zm-5 0v-3H2v3h2z"
              />
            </svg>
          </div>
          <span class="align-bottom pl-1">{{ automat.automatName }}</span>
        </router-link>
      </li>
      <li class="nav-item">
        <router-link class="nav-link text-light" to="/automats">
          <div style="font-size: 1em; display: inline-block">
            <svg
              width="1.5em"
              height="1em"
              viewBox="0 0 16 16"
              class="bi bi-box"
              fill="currentColor"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                fill-rule="evenodd"
                d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5 8.186 1.113zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z"
              />
            </svg>
          </div>
          <span class="align-bottom pl-1">Automaten</span>
        </router-link>
      </li>
      <li class="nav-item">
        <router-link class="nav-link text-light" to="/products">
          <svg
            width="1.5em"
            height="1em"
            viewBox="0 0 16 16"
            class="bi bi-bag"
            fill="currentColor"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              fill-rule="evenodd"
              d="M8 1a2.5 2.5 0 0 0-2.5 2.5V4h5v-.5A2.5 2.5 0 0 0 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5v9a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V5H2z"
            />
          </svg>
          <span class="align-bottom pl-1">Produkte</span>
        </router-link>
      </li>
      <li class="nav-item">
        <router-link class="nav-link text-light" to="/productTypes">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="1.5em"
            height="1em"
            viewBox="0 0 16 16"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
            class="feather feather-users"
          >
            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
            <circle cx="9" cy="7" r="4"></circle>
            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
          </svg>
          <span class="align-bottom pl-1">Produktarten</span>
        </router-link>
      </li>
      <li class="nav-item d-block d-md-none" @click="logout()">
        <router-link class="nav-link text-light" to="/login">
          <b-icon icon="x-circle"></b-icon>
          <span class="align-bottom pl-1">Logout</span>
        </router-link>
      </li>
    </ul>
  </div>
</template>
<script>
export default {
  name: "Menu",
  data: function () {
    return {
      automats: [],
    };
  },
  mounted() {
    this.getAutomatNames();
  },
  methods: {
    getAutomatNames: function () {
      axios
        .get("/api/automats/names")
        .then((response) => {
          this.automats = response.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
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
</style>