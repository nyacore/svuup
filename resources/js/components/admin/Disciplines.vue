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
      <v-data-table :headers="headers" :items="DISCIPLINES.data" item-key="id"></v-data-table>
    </v-card>

    <v-dialog v-model="disciplineDialog" width="500">
      <template v-slot:activator="{ on }">
        <v-btn v-on="on" color="primary" fab right bottom fixed>
          <v-icon>add</v-icon>
        </v-btn>
      </template>

      <v-card>
        <v-card-title class="headline primary white--text" primary-title>Новая дисциплина</v-card-title>

        <v-card-text>
          <form ref="disciplineForm" id="faculty">
            <v-text-field name="name" label="Название"></v-text-field>
            <v-select
              :items="SPECIALITIES.data"
              item-text="name"
              name="speciality_id"
              item-value="id"
              label="Направление"
            ></v-select>
            <v-select
              :items="USERS.data"
              item-text="name"
              name="user_id"
              item-value="id"
              label="Преподаватель"
            ></v-select>
            <v-text-field type="number" name="semester" label="Семестр"></v-text-field>
          </form>
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="primary" text @click="disciplineDialog = false">Отмена</v-btn>
          <v-btn :loading="loading" color="primary" @click="submit">Сохранить</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-container>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
export default {
  data: () => ({
    search: "",
    loading: false,
    disciplineDialog: false,
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
      }
    ]
  }),
  mounted() {
    this.FETCH_DISCIPLINES();
    this.FETCH_SPECIALITIES();
    this.FETCH_TEACHERS();
  },
  methods: {
    ...mapActions([
      "FETCH_DISCIPLINES",
      "STORE_DISCIPLINE",
      "FETCH_SPECIALITIES",
      "FETCH_TEACHERS"
    ]),
    submit() {
      const formData = new FormData(this.$refs.disciplineForm);

      this.loading = true;
      this.STORE_DISCIPLINE(formData);
      this.loading = false;

      this.FETCH_DISCIPLINES();
      this.disciplineDialog = false;
    }
  },
  computed: {
    ...mapGetters(["DISCIPLINES", "USERS", "SPECIALITIES"])
  }
};
</script>
