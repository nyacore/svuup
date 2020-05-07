<template>
  <v-container>
    <v-row justify="space-between">
      <v-col>
        <v-data-table :headers="headers" :items="LEADS" :items-per-page="5" class="elevation-1"></v-data-table>
      </v-col>
      <v-col sm="12" lg="3">
        <v-card class="mb-2">
          <v-card-text>
            <v-select v-model="callScenario" label="Сценарий прозвона" :items="SCENARIOS"></v-select>
          </v-card-text>
        </v-card>
        <v-card class="mb-2">
          <v-card-text>
            <v-checkbox label="Время клиента"></v-checkbox>
          </v-card-text>
        </v-card>
        <v-card class="mb-2">
          <v-card-subtitle>Дата звонка</v-card-subtitle>
          <v-card-text>
            <v-menu
              v-model="afterTimePicker"
              :close-on-content-click="false"
              :nudge-right="40"
              transition="scale-transition"
              offset-y
              min-width="290px"
            >
              <template v-slot:activator="{ on }">
                <v-text-field v-model="afterDate" label="После" prepend-icon="event" v-on="on"></v-text-field>
              </template>
              <v-date-picker v-model="afterDate" @input="afterTimePicker = false"></v-date-picker>
            </v-menu>
            <v-menu
              v-model="beforeTimePicker"
              :close-on-content-click="false"
              :nudge-right="40"
              transition="scale-transition"
              offset-y
              min-width="290px"
            >
              <template v-slot:activator="{ on }">
                <v-text-field v-model="beforeDate" label="До" prepend-icon="event" v-on="on"></v-text-field>
              </template>
              <v-date-picker v-model="beforeDate" @input="beforeTimePicker = false"></v-date-picker>
            </v-menu>
          </v-card-text>
        </v-card>
        <v-card class="mb-2">
          <v-card-subtitle>Последний звонок:</v-card-subtitle>
          <v-card-text>
            <v-select v-model="model" :items="['Стандартный']"></v-select>
            <v-select label="Выберите сценарий:" v-model="model" :items="['Стандартный']"></v-select>
          </v-card-text>
        </v-card>
        <v-card class="mb-2">
          <v-card-text>
            <multi-select :items="TAGS" label="Теги"></multi-select>
          </v-card-text>
        </v-card>
        <v-card>
          <v-card-text>
            <multi-select :items="['Новые', 'Просроченные']" label="Задачи"></multi-select>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
    <v-btn color="primary" fab right fixed bottom>
      <v-icon>add</v-icon>
    </v-btn>
  </v-container>
</template>

<script>
import MultiSelect from "./ui/MultiSelect";

import { mapGetters, mapActions } from "vuex";

export default {
  components: {
    "multi-select": MultiSelect
  },
  data: () => ({
    afterTimePicker: false,
    afterDate: null,
    beforeTimePicker: false,
    beforeDate: null,
    callScenario: "",
    tags: [],
    headers: [
      {
        text: "Имя",
        align: "start",
        sortable: false,
        value: "name"
      },
      {
        text: "Email",
        sortable: false,
        value: "email"
      },
      {
        text: "Телефон",
        sortable: false,
        value: "phone"
      }
    ]
  }),
  async mounted() {
    await this.FETCH_SCENARIOS();
    this.callScenario = this.SCENARIOS[0];

    this.FETCH_TAGS();
    this.FETCH_LEADS();
  },
  computed: {
    ...mapGetters(["SCENARIOS", "TAGS", "LEADS"])
  },
  methods: {
    ...mapActions(["FETCH_SCENARIOS", "FETCH_TAGS", "FETCH_LEADS"])
  }
};
</script>
