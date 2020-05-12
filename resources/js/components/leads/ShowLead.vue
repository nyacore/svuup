<template>
  <v-container fluid class="fill-height">
    <v-row justify="space-around" class="fill-height">
      <v-col cols="4">
        <v-card class="fill-height" flat>
          <v-card-title>{{ lead.name }}</v-card-title>
          <v-card-subtitle>{{ lead.phones }}</v-card-subtitle>

          <v-btn class="ma-2" color="primary">Позвонить</v-btn>

          <v-divider></v-divider>

          <v-card-text class="fill-height" style="overflow-y: scroll; max-height: 65vh">
            <form @submit.prevent="submit">
              <v-text-field v-model="lead.name" label="Название" name="name"></v-text-field>
              <v-text-field
                v-model="lead.phones"
                prepend-icon="phone"
                label="Телефон"
                name="phones"
              ></v-text-field>
              <v-text-field v-model="lead.emails" prepend-icon="email" label="Email" name="emails"></v-text-field>
              <v-text-field v-model="lead.sites" prepend-icon="web" label="Сайт" name="sites"></v-text-field>
              <v-text-field
                v-model="lead.city"
                prepend-icon="location_city"
                label="Город"
                name="city"
              ></v-text-field>
              <v-text-field v-model="lead.street" label="Адрес" name="address"></v-text-field>
              <v-text-field v-model="lead.region" label="Регион" name="region"></v-text-field>
              <v-text-field v-model="lead.activity" label="Сфера деятельности" name="activity"></v-text-field>
              <v-text-field v-model="lead.INN" label="ИНН" name="INN"></v-text-field>
              <v-text-field v-model="lead.KPP" label="КПП" name="KPP"></v-text-field>
              <multi-select v-model="lead.tags" :items="TAGS" label="Теги"></multi-select>
              <v-textarea v-model="lead.desc" name="description" label="Описание" rows="3"></v-textarea>
              <v-text-field v-model="lead.responsible" label="Ответственный" name="responsible"></v-text-field>
            </form>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn exact text :to="{ name: 'leads' }">Отмена</v-btn>
            <v-btn @click="submit" color="primary">Сохранить</v-btn>
          </v-card-actions>
        </v-card>
      </v-col>
      <v-col cols="7">
        <v-tabs @change="changeTab" flat v-model="tab">
          <v-tabs-slider></v-tabs-slider>

          <v-tab v-for="tab in tabs" :key="tab.value" :href="`#${tab.value}`">{{ tab.title }}</v-tab>

          <v-tab-item v-for="tab in tabs" :key="tab.value" :value="tab.value">
            <component :is="tab.component"></component>
          </v-tab-item>
        </v-tabs>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import MultiSelect from "../ui/MultiSelect";
import HistoryTab from "./tabs/HistoryTab";
import ScenarioTab from "./tabs/ScenarioTab";
import TasksTab from "./tabs/TasksTab";

import { mapGetters, mapActions } from "vuex";

export default {
  data: () => ({
    tab: "",
    tabs: [
      { title: "Сценарий", value: "scenario", component: "scenario-tab" },
      { title: "История", value: "history", component: "history-tab" },
      { title: "Задачи", value: "tasks", component: "tasks-tab" }
    ],
    lead: {
      name: "",
      phones: "",
      emails: "",
      sites: "",
      city: "",
      street: "",
      region: "",
      activity: "",
      INN: "",
      KPP: "",
      tags: "",
      desc: "",
      responsible: ""
    }
  }),
  components: {
    "multi-select": MultiSelect,
    "scenario-tab": ScenarioTab,
    "history-tab": HistoryTab,
    "tasks-tab": TasksTab
  },
  async mounted() {
    this.FETCH_TAGS();

    await this.FETCH_LEAD(this.$route.params.id);

    this.lead = this.LEADS[0];
  },
  methods: {
    ...mapActions(["FETCH_TAGS", "STORE_LEAD", "FETCH_LEAD"]),
    submit(e) {
      this.STORE_LEAD(this.lead);
    },
    changeTab(e) {
      this.$router.replace({ hash: `#${e}` });
    }
  },
  computed: {
    ...mapGetters(["TAGS", "LEADS"])
  }
};
</script>

<style scoped>
</style>
