<template>
  <v-container>
    <v-card>
      <v-card-title>
        Пользователи
        <v-spacer></v-spacer>
        <v-text-field
          v-model="search"
          append-icon="mdi-magnify"
          label="Поиск"
          single-line
          hide-details
        ></v-text-field>
      </v-card-title>
      <v-data-table :headers="headers" :items="USERS.data" :search="search"></v-data-table>
    </v-card>
    <v-dialog v-model="userDialog" width="500">
      <template v-slot:activator="{ on }">
        <v-btn v-on="on" color="primary" fab right bottom fixed>
          <v-icon>add</v-icon>
        </v-btn>
      </template>

      <v-card>
        <v-card-title class="headline primary white--text" primary-title>Новый пользователь</v-card-title>

        <v-card-text>
          <form ref="userForm" id="user">
            <v-text-field name="name" label="ФИО"></v-text-field>
            <v-text-field type="password" label="Пароль" name="password"></v-text-field>
            <v-text-field label="Email" name="email"></v-text-field>
            <v-select
              :items="ROLES.data"
              item-text="name"
              name="role_id"
              item-value="id"
              label="Должность"
            ></v-select>
          </form>
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="primary" text @click="userDialog = false">Отмена</v-btn>
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
    userDialog: false,
    loading: false,
    search: "",
    headers: [
      {
        text: "Номер документа",
        align: "start",
        sortable: true,
        value: "id"
      },
      {
        text: "ФИО",
        value: "name"
      },
      {
        text: "Должность",
        value: "role.name"
      }
    ]
  }),
  mounted() {
    this.FETCH_USERS();
    this.FETCH_ROLES();
  },
  methods: {
    ...mapActions(["FETCH_USERS", "FETCH_ROLES", "STORE_USER"]),
    submit() {
      const formData = new FormData(this.$refs.userForm);

      this.loading = true;
      this.STORE_USER(formData);
      this.loading = false;

      this.userDialog = false;
      this.FETCH_USERS();
    }
  },
  computed: {
    ...mapGetters(["USERS", "ROLES"])
  }
};
</script>
