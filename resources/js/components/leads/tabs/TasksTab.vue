<template>
  <v-data-table :headers="headers" :items="TASKS" flat>
    <template v-slot:top>
      <v-toolbar flat color="white">
        <v-spacer></v-spacer>
        <v-dialog v-model="taskDialog" max-width="500px">
          <template v-slot:activator="{ on }">
            <v-btn color="primary" dark class="mb-2" v-on="on">Новая задача</v-btn>
          </template>

          <edit-task @cancel="taskDialog = false" :task="editedTask" title="Новая задача"></edit-task>
        </v-dialog>
      </v-toolbar>
    </template>
    <template v-slot:item.completed="{ item }">
      <v-simple-checkbox v-model="item.completed"></v-simple-checkbox>
    </template>
    <template v-slot:item.date="{ item }">{{ new Date(item.date).toLocaleString() }}</template>
    <template v-slot:item.created_at="{ item }">{{ new Date(item.created_at).toLocaleDateString() }}</template>
    <template v-slot:item.actions="{ item }">
      <v-icon small class="mr-2" @click="editTask(item)">mdi-pencil</v-icon>
      <v-icon small @click="deleteTask(item)">mdi-delete</v-icon>
    </template>
  </v-data-table>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

import EditTask from "./EditTask";

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
      },
      {
        text: "Выполнена",
        sortable: true,
        value: "completed"
      },
      {
        text: "Действия",
        sortable: false,
        value: "actions"
      }
    ],
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
    async editTask(item) {
      this.editedTask = item;
      this.taskDialog = true;
    }
  },
  computed: {
    ...mapGetters(["TASKS"])
  },
  components: {
    "edit-task": EditTask
  }
};
</script>
