<template>
  <v-data-table
    :server-items-length="tasks.total"
    :items-per-page="tasks.per_page"
    @update:page="updatePage"
    :headers="headers"
    :items="tasks.data"
    flat
  >
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
import { mapActions, mapGetters } from "vuex";

import EditTask from "../leads/tabs/EditTask";

export default {
  components: {
    "edit-task": EditTask
  },
  props: {
    tasks: {
      type: Object,
      required: true
    }
  },
  data: () => ({
    editedTask: {},
    taskDialog: false,
    currentPage: 1,
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
        text: "Кому",
        sortable: true,
        value: "lead.phones"
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
    ]
  }),
  methods: {
    ...mapActions(["DELETE_TASK"]),
    editTask(task) {
      this.editedTask = task;
      this.taskDialog = true;
    },
    deleteTask(task) {
      this.DELETE_TASK(task.id);
      this.$emit("deleted", this.currentPage);
    },
    updatePage(page) {
      this.currentPage = page;
      this.$emit("update:page", this.currentPage);
    }
  }
};
</script>
