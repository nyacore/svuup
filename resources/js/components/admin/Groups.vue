<template>
  <v-container>
    <v-card>
      <v-card-title>
        Группы
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
        :headers="headers"
        :items="GROUPS.data"
        item-key="id"
        show-expand
        :expanded.sync="expanded"
      >
        <template v-slot:expanded-item="{ headers, item }">
          <td class="pa-0" :colspan="headers.length">
            <v-list dense disabled>
              <v-subheader>СТУДЕНТЫ</v-subheader>
              <v-divider></v-divider>
              <v-list-item-group color="primary">
                <template v-if="item.users.length">
                  <v-list-item v-for="user in item.users" :key="user.id">
                    <v-list-item-content>
                      <v-list-item-title v-html="user.name"></v-list-item-title>
                    </v-list-item-content>
                  </v-list-item>
                </template>
                <v-list-item v-else>
                  <v-list-item-content>
                    <v-list-item-title>Студентов не найдено</v-list-item-title>
                  </v-list-item-content>
                </v-list-item>
              </v-list-item-group>
            </v-list>
            <v-row class="px-5">
              <v-col cols="5">
                <form ref="studentForm">
                  <v-select
                    :items="USERS.data"
                    item-text="name"
                    name="user_id"
                    item-value="id"
                    label="Добавить студента"
                  ></v-select>
                </form>
                <v-btn :loading="loading" color="primary" @click="addStudent(item.id)">Добавить</v-btn>
              </v-col>
            </v-row>
          </td>
        </template>
      </v-data-table>
    </v-card>

    <v-dialog v-model="groupDialog" width="500">
      <template v-slot:activator="{ on }">
        <v-btn v-on="on" color="primary" fab right bottom fixed>
          <v-icon>add</v-icon>
        </v-btn>
      </template>

      <v-card>
        <v-card-title class="headline primary white--text" primary-title>Новая группа</v-card-title>

        <v-card-text>
          <v-text-field name="name" label="Название"></v-text-field>
          <form ref="studentForm">
            <v-select
              :items="SPECIALITIES.data"
              item-text="name"
              item-value="id"
              name="speciality_id"
              label="Направление"
              v-model="student"
            ></v-select>
          </form>
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="primary" text @click="groupDialog = false">Отмена</v-btn>
          <v-btn :loading="loading" color="primary" @click="submit">Сохранить</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-container>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
export default {
  data: () => ({
    loading: false,
    groupDialog: false,
    search: "",
    expanded: [],
    student: 0,
    headers: [
      {
        value: "name",
        text: "Название"
      },
      {
        value: "speciality.name",
        text: "Направление"
      },
      { text: "", value: "data-table-expand" }
    ]
  }),
  mounted() {
    this.FETCH_GROUPS();
    this.FETCH_SPECIALITIES();
    this.FETCH_STUDENTS();
  },
  methods: {
    ...mapActions([
      "FETCH_GROUPS",
      "FETCH_SPECIALITIES",
      "STORE_GROUP",
      "FETCH_STUDENTS",
      "ATTACH_STUDENT"
    ]),
    async submit() {
      const formData = new FormData(this.$refs.groupForm);

      this.loading = true;
      await this.STORE_GROUP(formData);
      this.loading = false;

      this.groupDialog = false;
      this.FETCH_GROUPS();
    },
    async addStudent(groupId) {
      const formData = new FormData(this.$refs.studentForm);

      this.loading = true;
      this.ATTACH_STUDENT({ groupId, data: formData });
      this.loading = false;

      this.FETCH_GROUPS();
    }
  },
  computed: {
    ...mapGetters(["GROUPS", "SPECIALITIES", "USERS"])
  }
};
</script>
