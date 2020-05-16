<template>
  <v-container>
    <tasks-table :tasks="TASKS" @update:page="updatePage" @deleted="taskDeleted"></tasks-table>
  </v-container>
</template>

<script>
import { mapActions, mapGetters } from "vuex";

import TasksTable from "./TasksTable";

export default {
  components: {
    "tasks-table": TasksTable
  },
  async mounted() {
    await this.FETCH_TASKS();
  },
  methods: {
    ...mapActions(["FETCH_TASKS"]),
    updatePage(page) {
      this.FETCH_TASKS(page);
    },
    taskDeleted(page) {
      this.FETCH_TASKS;
    }
  },
  computed: {
    ...mapGetters(["TASKS"])
  }
};
</script>
