<template>
  <v-container class="fill-height" fluid>
    <v-row align="center" justify="center">
      <v-col cols="12" sm="8" md="4">
        <v-card class="elevation-12">
          <v-toolbar color="primary" dark flat>
            <v-toolbar-title>Авторизация</v-toolbar-title>
            <v-spacer />
          </v-toolbar>
          <v-card-text>
            <v-form @submit.prevent="login">
              <v-text-field
                label="E-mail"
                v-model="email"
                name="email"
                prepend-icon="person"
                type="text"
              />

              <v-text-field
                id="password"
                v-model="password"
                label="Пароль"
                name="password"
                prepend-icon="lock"
                type="password"
              />
            </v-form>
          </v-card-text>
          <v-card-actions>
            <v-spacer />
            <v-btn type="submit" @click="login" color="primary">Войти</v-btn>
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
  data: () => ({
    email: "",
    password: ""
  }),
  methods: {
    ...mapActions(["LOGIN_USER"]),
    async login(event) {
      try {
        await this.LOGIN_USER({
          email: this.email,
          password: this.password
        });
        this.$router.push({ name: "dashboard" });
      } catch (e) {
        this.$toast.error("Неверный логин или пароль");
      }
    }
  },
  mounted() {
    if (this.LOGGED_IN) {
      this.$router.push({ name: "dashboard" });
    }
  },
  computed: {
    ...mapGetters(["LOGGED_IN"])
  }
};
</script>
