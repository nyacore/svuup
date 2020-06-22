<template>
  <v-container>
    <v-row>
      <v-col cols="6">
        <v-simple-table>
          <template v-slot:default>
            <thead>
              <tr>
                <th class="text-left">Дисциплина</th>
                <th class="text-left">Балл</th>
              </tr>
            </thead>
            <tbody>
              <tr
                @click="$router.push({name: 'events', params: {discipline: index}})"
                v-for="(item, index) in DISCIPLINES.data"
                :key="item.name"
              >
                <td>{{ item.name }}</td>
                <td>
                  <v-btn
                    :color="color(currentMark(item), maxMark(item))"
                    small
                    depressed
                    fab
                  >{{ currentMark(item) }}</v-btn>
                  из {{ maxMark(item) }}
                </td>
              </tr>
            </tbody>
          </template>
        </v-simple-table>
      </v-col>
      <v-col cols="4">
        <router-view></router-view>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import { mapActions, mapGetters } from "vuex";

export default {
  mounted() {
    this.FETCH_DISCIPLINES();
  },
  computed: {
    ...mapGetters(["DISCIPLINES"])
  },
  methods: {
    maxMark(discipline) {
      if (discipline.events) {
        return discipline.events.reduce((sum, event) => (sum += event.max), 0);
      } else return 0;
    },
    currentMark(discipline) {
      if (discipline.events) {
        return discipline.events.reduce(
          (sum, event) => (sum += event.marks[0].mark),
          0
        );
      } else return 0;
    },
    ...mapActions(["FETCH_DISCIPLINES"]),
    /**
     * 2 - Отлично
     * 1 - Хорошо
     * 0 - Удовлетворительно
     */
    color(current, max) {
      const ratio = current / max;

      if (ratio < 0.3) {
        return "error";
      } else if (ratio < 0.7) {
        return "warning";
      } else return "success";
    }
  }
};
</script>
