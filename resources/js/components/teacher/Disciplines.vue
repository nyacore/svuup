<template>
  <v-container>
    <v-card>
      <v-card-title>
        Дисциплины
        <v-spacer></v-spacer>
        <v-text-field
          v-model="search"
          append-icon="mdi-magnify"
          label="Поиск"
          single-line
          hide-details
        ></v-text-field>
      </v-card-title>
      <v-data-table
        @click:row="goToMarks"
        :headers="headers"
        :items="DISCIPLINES.data"
        show-expand
        item-key="id"
      >
        <template v-slot:expanded-item="{ headers, item }">
          <td class="pa-0" :colspan="headers.length">
            <v-list two-line dense disabled>
              <v-subheader>КОНТРОЛЬНЫЕ МЕРОПРИЯТИЯ</v-subheader>
              <v-divider></v-divider>
              <v-list-item-group color="primary">
                <template v-if="item.events.length">
                  <v-list-item v-for="event in item.events" :key="event.id">
                    <v-list-item-content>
                      <v-list-item-title v-html="event.name"></v-list-item-title>
                      <v-list-item-subtitle>Максимум баллов: {{ event.max }}</v-list-item-subtitle>
                    </v-list-item-content>
                  </v-list-item>
                </template>
                <v-list-item v-else>
                  <v-list-item-content>
                    <v-list-item-title>Контрольных мероприятий не найдено</v-list-item-title>
                  </v-list-item-content>
                </v-list-item>
              </v-list-item-group>
            </v-list>
            <v-dialog v-model="eventDialog" width="500">
              <template v-slot:activator="{ on }">
                <v-btn class="ma-2" v-on="on" color="primary">Добавить</v-btn>
              </template>

              <v-card>
                <v-card-title
                  class="headline primary white--text"
                  primary-title
                >Новое контрольное мероприятие</v-card-title>

                <v-card-text>
                  <form ref="eventForm" id="speciality">
                    <v-text-field name="name" label="Название"></v-text-field>
                    <v-text-field type="number" name="max" label="Максимум баллов"></v-text-field>
                    <input type="hidden" :value="item.id" name="discipline_id" />
                  </form>
                </v-card-text>

                <v-divider></v-divider>

                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn color="primary" text @click="eventDialog = false">Отмена</v-btn>
                  <v-btn :loading="loading" color="primary" @click="submitEvent">Сохранить</v-btn>
                </v-card-actions>
              </v-card>
            </v-dialog>
          </td>
        </template>
      </v-data-table>
    </v-card>
  </v-container>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
export default {
  data: () => ({
    search: "",
    loading: false,
    eventDialog: false,
    headers: [
      {
        text: "Название",
        value: "name"
      },
      {
        text: "Преподаватель",
        value: "user.name"
      },
      {
        text: "Семестр",
        value: "semester"
      },
      { text: "", value: "data-table-expand" }
    ]
  }),
  mounted() {
    this.FETCH_DISCIPLINES();
  },
  methods: {
    ...mapActions(["FETCH_DISCIPLINES", "STORE_EVENT"]),
    submitEvent() {
      const formData = new FormData(this.$refs.eventForm);

      this.loading = true;
      this.STORE_EVENT(formData);
      this.loading = false;

      this.FETCH_DISCIPLINES();
      this.eventDialog = false;
    },
    goToMarks(item) {
      this.$router.push({
        name: "teacher.disciplines.view",
        params: { discipline: item.id }
      });
    }
  },
  computed: {
    ...mapGetters(["DISCIPLINES"])
  }
};
</script>
