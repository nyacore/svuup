<template>
  <v-data-table :headers="headers" :items="TASKS" flat>
    <template v-slot:item.completed="{ item }">
      <v-simple-checkbox v-model="item.completed"></v-simple-checkbox>
    </template>
    <template v-slot:item.date="{ item }">{{ new Date(item.date).toLocaleString() }}</template>
    <template v-slot:item.created_at="{ item }">{{ new Date(item.created_at).toLocaleDateString() }}</template>
    <template v-slot:item.actions="{ item }">
      <v-icon small class="mr-2" @click="editItem(item)">mdi-pencil</v-icon>
      <v-icon small @click="deleteItem(item)">mdi-delete</v-icon>
    </template>
  </v-data-table>
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
