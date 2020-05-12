<template>
  <v-data-table :headers="headers" :items="TASKS" flat></v-data-table>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
  data: () => ({
    headers: [
      {
        text: "Дата и время",
        align: "start",
        sortable: false,
        value: "date"
      },
      {
        text: "Тип",
        sortable: false,
        value: "type"
      },
      {
        text: "Назначил",
        sortable: false,
        value: "user.name"
      },
      {
        text: "Дата назначения",
        sortable: false,
        value: "created_at"
      },
      {
        text: "Исполнитель",
        sortable: false,
        value: "performer"
      }
    ]
  }),
  mounted() {
    this.FETCH_TASKS_BY_LEAD(this.$route.params.id);
  },
  methods: {
    ...mapActions(["FETCH_TASKS_BY_LEAD"])
  },
  computed: {
    ...mapGetters(["TASKS"])
  }
};
</script>
