<template>
  <tasks-table :tasks="TASKS" @update:page="updatePage" @deleted="taskDeleted"></tasks-table>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

import TasksTable from "../../tasks/TasksTable";

export default {
  data: () => ({
    editedTask: {},
    taskDialog: false
  }),
  mounted() {
    this.FETCH_TASKS_BY_LEAD(this.$route.params.id);
  },
  methods: {
    ...mapActions(["FETCH_TASKS_BY_LEAD", "DELETE_TASK"]),
    async deleteTask(task) {
      await this.DELETE_TASK(task.id);
      await this.FETCH_TASKS_BY_LEAD(this.$route.params.id);
    },
    taskDeleted(page) {
      this.FETCH_TASKS_BY_LEAD(this.$route.params.id, page);
    },
    updatePage(page) {
      this.FETCH_TASKS_BY_LEAD(this.$route.params.id, page);
    }
  },
  computed: {
    ...mapGetters(["TASKS"])
  },
  components: {
    "tasks-table": TasksTable
  }
};
</script>
