<template>
  <v-container>
    <v-row :key="speciality.id" v-for="speciality in DISCIPLINES.data[0].specialities">
      <template v-if="speciality.groups.length">
        <v-col>
          <v-subheader>{{ speciality.name }}</v-subheader>
          <v-row v-for="group in speciality.groups" :key="group.id">
            <v-col>
              <v-subheader>{{ group.name }}</v-subheader>
              <v-simple-table>
                <template v-slot:default>
                  <thead>
                    <tr>
                      <th class="text-left">Студент</th>
                      <th
                        v-for="event in DISCIPLINES.data[0].events"
                        :key="event.id"
                        class="text-left"
                      >{{ event.name }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="student in group.users" :key="student.id">
                      <td>{{ student.name }}</td>
                      <td v-for="mark in DISCIPLINES.data[0].events" min="0" :key="mark.id">
                        <v-row align="center">
                          <v-col cols="6">
                            <v-text-field
                              :rules="[rules.min, rules.max(mark.max, MARKS.data[findMark(student.id, mark.id)].mark)]"
                              v-model="MARKS.data[findMark(student.id, mark.id)].mark"
                              type="number"
                              @input="changeMark(findMark(student.id, mark.id), $event)"
                            ></v-text-field>
                          </v-col>
                          из {{mark.max}}
                        </v-row>
                      </td>
                    </tr>
                  </tbody>
                </template>
              </v-simple-table>
            </v-col>
          </v-row>
        </v-col>
      </template>
    </v-row>
    <v-btn @click="submit" :loading="loading" color="primary">Сохранить</v-btn>
  </v-container>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from "vuex";
export default {
  data: () => ({
    loading: false,
    rules: {
      min: v => v >= 0 || "Значение не может быть отрицательным",
      max: (max, v) =>
        v <= max || "Значение не может превышать максимальный балл"
    }
  }),
  async mounted() {
    await this.FETCH_DISCIPLINE(this.$route.params.discipline);
    await this.FETCH_MARKS();
  },
  methods: {
    ...mapActions(["FETCH_DISCIPLINE", "FETCH_MARKS", "STORE_MARKS"]),
    ...mapMutations(["SET_MARK"]),
    findMark(studentId, eventId) {
      const index = this.MARKS.data.findIndex(
        e => e.user_id == studentId && e.event_id == eventId
      );

      if (index == -1) {
        return 0;
      }

      return index;
    },
    submit() {
      this.loading = true;
      this.STORE_MARKS({ marks: this.MARKS.data });
      this.loading = false;

      this.FETCH_MARKS();
    },
    changeMark(index, value) {
      this.SET_MARK({ index, value });
    }
  },
  computed: {
    ...mapGetters(["DISCIPLINES", "MARKS"])
  }
};
</script>
