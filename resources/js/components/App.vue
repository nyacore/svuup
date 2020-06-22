<template>
  <v-app id="inspire">
    <v-navigation-drawer
      mini-variant-width="120"
      mini-variant
      color="primary"
      dark
      app
      v-if="LOGGED_IN"
    >
      <v-list-item>
        <!-- <v-list-item-avatar color="white">
          <v-icon color="primary">mdi-account-circle</v-icon>
        </v-list-item-avatar>-->
      </v-list-item>
      <v-divider></v-divider>
      <v-list dense nav>
        <v-list-item v-for="item in navigation" :key="item.route" :to="{ name: item.route }" link>
          <v-list-item-content>
            <v-list-item-title class="text-center">
              <v-icon>{{ item.icon }}</v-icon>
            </v-list-item-title>
            <v-list-item-subtitle class="text-center">{{ item.text }}</v-list-item-subtitle>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>

    <v-app-bar app>
      <v-toolbar-title>Система взаимодействия участников учебного процесса</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-menu transition="slide-y-transition" min-width="150" offset-y v-if="LOGGED_IN">
        <template v-slot:activator="{ on }">
          <v-btn v-on="on" fab color="primary">{{ USER.name ? USER.name[0] : '' }}</v-btn>
        </template>
        <v-list>
          <v-list-item>
            <v-list-item-icon>
              <v-icon>settings</v-icon>
            </v-list-item-icon>
            <v-list-item-title>Настройки</v-list-item-title>
          </v-list-item>
          <v-divider></v-divider>
          <v-list-item @click="logout">
            <v-list-item-icon>
              <v-icon>exit_to_app</v-icon>
            </v-list-item-icon>
            <v-list-item-title>Выход</v-list-item-title>
          </v-list-item>
        </v-list>
      </v-menu>
    </v-app-bar>

    <v-content>
      <router-view></router-view>
    </v-content>
  </v-app>
</template>

<script>
import { mapGetters, mapActions, mapMutations } from "vuex";

import { admin, teacher, student } from "../navigation";

export default {
  props: {
    source: String
  },
  computed: {
    ...mapGetters(["LOGGED_IN", "USER"]),
    navigation() {
      if (!this.USER.role.stub) {
        return student;
      }

      switch (this.USER.role.stub) {
        case "admin":
          return admin;
        case "teacher":
          return teacher;
        case "student":
          return student;
      }
    }
  },
  methods: {
    ...mapMutations(["LOGOUT"]),
    ...mapActions(["FETCH_USER"]),
    logout() {
      this.LOGOUT();
      this.$router.push({ name: "sign-in" });
    }
  },
  async mounted() {
    if (this.LOGGED_IN) {
      try {
        await this.FETCH_USER();
      } catch (e) {
        this.$router.push({ name: "login" });
      }
    }
  }
};
</script>
