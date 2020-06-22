<template>
  <v-simple-table>
    <template v-slot:default>
      <thead>
        <tr>
          <th class="text-left">Контрольное мероприятие</th>
          <th class="text-left">Балл</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="event in DISCIPLINES.data[$route.params.discipline].events" :key="event.id">
          <td>{{ event.name }}</td>
          <td>
            <v-btn
              :color="color(event.marks[0].mark, event.max)"
              small
              depressed
              fab
            >{{ event.marks[0].mark }}</v-btn>
            из {{ event.max }}
          </td>
        </tr>
      </tbody>
    </template>
  </v-simple-table>
</template>
<script>
import { mapGetters } from "vuex";
export default {
  computed: {
    ...mapGetters(["DISCIPLINES"])
  },
  methods: {
    currentMark(event) {},
    maxMark(event) {},
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
