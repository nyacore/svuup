<template>
  <v-container>
    <v-card>
      <v-card-title>
        Факультеты
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
        :items="FACULTIES.data"
        :expanded.sync="expanded"
        item-key="name"
        show-expand
      >
        <template v-slot:expanded-item="{ headers, item }">
          <td class="pa-0" :colspan="headers.length">
            <v-expansion-panels multiple accordion tile>
              <v-expansion-panel v-for="speciality in item.specialities" :key="speciality.id">
                <v-expansion-panel-header>
                  <v-row no-gutters>
                    <v-col cols="4">{{ speciality.name }}</v-col>
                    <v-col class="text--secondary" cols="4">Семестров: {{ speciality.semesters }}</v-col>
                  </v-row>
                </v-expansion-panel-header>
                <v-expansion-panel-content>
                  <v-row no-gutters>
                    <v-col cols="5">
                      <v-select
                        label="Дисциплины"
                        multiple
                        chips
                        flat
                        solo
                        item-value="id"
                        item-text="name"
                        v-model="speciality.selectedDisciplines"
                        :items="DISCIPLINES.data"
                      ></v-select>
                    </v-col>

                    <v-divider vertical class="mx-4"></v-divider>

                    <v-col cols="3"></v-col>
                  </v-row>

                  <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                      :loading="loading"
                      @click="syncDisciplines(speciality)"
                      color="primary"
                    >Сохранить</v-btn>
                    <v-btn @click="deleteSpeciality(speciality.id)" color="error">Удалить</v-btn>
                  </v-card-actions>
                </v-expansion-panel-content>
              </v-expansion-panel>
            </v-expansion-panels>
            <v-dialog v-model="specialityDialog" width="500">
              <template v-slot:activator="{ on }">
                <v-btn class="ma-2" v-on="on" color="primary">Добавить направление</v-btn>
              </template>

              <v-card>
                <v-card-title class="headline primary white--text" primary-title>Новое направление</v-card-title>

                <v-card-text>
                  <form ref="specialityForm" id="speciality">
                    <v-text-field name="name" label="Название"></v-text-field>
                    <v-text-field type="number" name="semesters" label="Количество семестров"></v-text-field>
                    <input type="hidden" :value="item.id" name="faculty_id" />
                  </form>
                </v-card-text>

                <v-divider></v-divider>

                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn color="primary" text @click="specialityDialog = false">Отмена</v-btn>
                  <v-btn :loading="loading" color="primary" @click="submitSpeciality">Сохранить</v-btn>
                </v-card-actions>
              </v-card>
            </v-dialog>
          </td>
        </template>
      </v-data-table>
    </v-card>

    <v-dialog v-model="facultyDialog" width="500">
      <template v-slot:activator="{ on }">
        <v-btn v-on="on" color="primary" fab right bottom fixed>
          <v-icon>add</v-icon>
        </v-btn>
      </template>

      <v-card>
        <v-card-title class="headline primary white--text" primary-title>Новый факультет</v-card-title>

        <v-card-text>
          <form ref="facultyForm" id="faculty">
            <v-text-field name="name" label="Название"></v-text-field>
          </form>
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="primary" text @click="facultyDialog = false">Отмена</v-btn>
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
    facultyDialog: false,
    specialityDialog: false,
    loading: false,
    expanded: [],
    search: "",
    disciplines: [],
    headers: [
      {
        value: "name",
        text: "Название"
      },
      { text: "", value: "data-table-expand" }
    ]
  }),
  methods: {
    ...mapActions([
      "FETCH_FACULTIES",
      "STORE_FACULTY",
      "STORE_SPECIALITY",
      "DELETE_SPECIALITY",
      "FETCH_DISCIPLINES",
      "SYNC_DISCIPLINES"
    ]),
    async submit() {
      const formData = new FormData(this.$refs.facultyForm);

      this.loading = true;
      await this.STORE_FACULTY(formData);
      this.loading = false;

      this.facultyDialog = false;
      this.FETCH_FACULTIES();
    },
    async submitSpeciality() {
      const formData = new FormData(this.$refs.specialityForm);

      this.loading = true;
      await this.STORE_SPECIALITY(formData);
      this.loading = false;

      this.specialityDialog = false;
      this.FETCH_FACULTIES();
    },
    async deleteSpeciality(id) {
      await this.DELETE_SPECIALITY(id);

      await this.FETCH_FACULTIES();
    },
    async syncDisciplines(speciality) {
      const formData = new FormData();

      console.log(speciality.selectedDisciplines);

      speciality.selectedDisciplines.forEach(d => {
        formData.append("disciplines[]", d);
      });
      this.loading = true;
      await this.SYNC_DISCIPLINES({ id: speciality.id, formData });
      this.loading = false;
      await this.FETCH_FACULTIES();
    }
  },
  computed: {
    ...mapGetters(["FACULTIES", "SPECIALITIES", "DISCIPLINES"])
  },
  mounted() {
    this.FETCH_FACULTIES();
    this.FETCH_DISCIPLINES();
  }
};
</script>
