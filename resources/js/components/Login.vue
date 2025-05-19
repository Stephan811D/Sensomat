<template>
  <div>
    <b-container>
      <b-row class="vh-100 text-center justify-content-center" align-v="center">
        <b-col xs="12" sm="10" md="8" lg="6" xl="5">
          <b-card>
            <b-form @submit.prevent="loginUser" v-if="show" class="form-signin">
              <img
                class="mb-4"
                src="/assets/Sensomat_Logo_Dark.png"
                alt=""
                width="125"
                height="125"
              />
              <b-form-group
                id="input-group-1"
                label-for="input-1"
                :description="this.error"
              >
                <b-form-input
                  id="input-1"
                  v-model="form.username"
                  placeholder="Benutzername"
                  required
                ></b-form-input>

                <b-form-input
                  id="input-2"
                  v-model="form.password"
                  type="password"
                  placeholder="Passwort"
                  required
                ></b-form-input>
              </b-form-group>
              <b-button type="submit" variant="primary">Anmelden</b-button>
            </b-form>
          </b-card>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>
<script>
import axios from "axios";

export default {
  data() {
    return {
      form: {
        username: null,
        password: null,
      },
      error: "",
      show: true,
    };
  },
  metaInfo: {
    bodyAttrs: {
      class: "login-body",
    },
  },
  methods: {
    async loginUser() {
      await axios
        .get("/sanctum/csrf-cookie")
        .then(() => {})
        .catch((error) => {
          console.log(error);
        });
      await axios
        .post("/api/login", this.form)
        .then(() => {
          this.$router.push({
            path: "/dashboard",
          });
        })
        .catch((error) => {
          if (error.response) {
            this.error = error.response.data.errors.login[0];
          }
        });
    },
  },
};
</script>

<style scoped>
.card {
  -webkit-box-shadow: 0px 18px 60px -20px rgba(0, 0, 0, 1);
  -moz-box-shadow: 0px 18px 60px -20px rgba(0, 0, 0, 1);
  box-shadow: 0px 18px 60px -20px rgba(0, 0, 0, 1);
  border-radius: 15px; /*25pt;*/
}

/deep/ .text-muted {
  color: #b30000 !important;
}

.form-signin {
  width: 100%;
  max-width: 330px;
  padding: 15px;
  margin: 0 auto;
}

.form-signin .checkbox {
  font-weight: 400;
}

.form-signin .form-control {
  position: relative;
  box-sizing: border-box;
  height: auto;
  padding: 10px;
  font-size: 16px;
}

.form-signin .form-control:focus {
  z-index: 2;
}

.form-signin input[type="text"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}

.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
</style>
