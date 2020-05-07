<template>
  <v-app id="inspire">
    <v-navigation-drawer :mini-variant="miniVariant" color="primary" dark app v-if="LOGGED_IN">
      <v-list-item>
        <v-list-item-avatar></v-list-item-avatar>
        <v-list-item-content>
          <v-list-item-title class="title">{{ USER.name }}</v-list-item-title>
          <v-list-item-subtitle>{{ USER.email }}</v-list-item-subtitle>
        </v-list-item-content>
      </v-list-item>
      <v-divider></v-divider>
      <v-list dense nav>
        <v-list-item v-for="item in navigation" :key="item.route" :to="item.route" link>
          <v-list-item-icon>
            <v-icon>{{ item.icon }}</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title>{{ item.text }}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>

    <v-app-bar app>
      <v-app-bar-nav-icon v-if="LOGGED_IN" @click.stop="miniVariant = !miniVariant" />
      <v-toolbar-title>Скорозвон</v-toolbar-title>
    </v-app-bar>

    <v-content>
      <router-view></router-view>
    </v-content>
  </v-app>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
  data: () => ({
    miniVariant: false,
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
        route: "support"
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
    ...mapActions(["FETCH_USER"])
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
