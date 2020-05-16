<template>
  <v-app id="inspire">
    <v-navigation-drawer
      mini-variant-width="100"
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
        <v-list-item
          v-for="item in navigation"
          :key="item.route"
          exact
          :to="{ name: item.route }"
          link
        >
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
      <v-toolbar-title>Скорозвон</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-text-field
        v-if="LOGGED_IN"
        single-line
        label="Найти или позвонить"
        dense
        prepend-icon="search"
      ></v-text-field>
      <v-btn v-if="LOGGED_IN" icon>
        <v-icon>notifications</v-icon>
      </v-btn>
      <v-menu transition="slide-y-transition" min-width="150" offset-y v-if="LOGGED_IN">
        <template v-slot:activator="{ on }">
          <v-btn v-on="on" fab color="primary">{{ USER.name ? USER.name[0] : '' }}</v-btn>
        </template>
        <v-list>
          <v-list-item>
            <v-list-item-icon>
              <v-icon>account_balance_wallet</v-icon>
            </v-list-item-icon>
            <v-list-item-title>Баланс</v-list-item-title>
          </v-list-item>
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
      <transition name="slide-left">
        <router-view></router-view>
      </transition>
    </v-content>
  </v-app>
</template>

<script>
import { mapGetters, mapActions, mapMutations } from "vuex";

export default {
  data: () => ({
    navigation: [
      {
        icon: "call",
        text: "Прозвон",
        route: "leads"
      },
      {
        icon: "contacts",
        text: "Контакты",
        route: "contacts"
      },
      {
        icon: "done",
        text: "Задачи",
        route: "tasks"
      },
      {
        icon: "assignment",
        text: "Отчеты",
        route: "reports"
      },
      {
        icon: "history",
        text: "Вызовы",
        route: "calls"
      },
      {
        icon: "contact_support",
        text: "Помощь",
        route: "help"
      }
    ]
  }),
  props: {
    source: String
  },
  computed: {
    ...mapGetters(["LOGGED_IN", "USER"])
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

<style>
.slide-left-enter-active,
.slide-left-leave-active,
.slide-right-enter-active,
.slide-right-leave-active {
  transition-duration: 0.5s;
  transition-property: height, opacity, transform;
  transition-timing-function: cubic-bezier(0.55, 0, 0.1, 1);
  overflow: hidden;
}

.slide-left-enter,
.slide-right-leave-active {
  opacity: 0;
  transform: translate(2em, 0);
}

.slide-left-leave-active,
.slide-right-enter {
  opacity: 0;
  transform: translate(-2em, 0);
}
</style>
