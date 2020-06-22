<template>
  <v-container>
    <template v-if="THREADS.data.length == 0">
      <v-subheader>Список диалогов пуст</v-subheader>
    </template>
    <v-card
      @click="$router.push({name: 'messages.thread', params: { thread: thread.id } })"
      class="mb-5"
      v-for="thread in THREADS.data"
      :key="thread.id"
    >
      <v-card-title>{{ thread.name }}</v-card-title>
      <v-card-subtitle>Сообщений: {{ thread.messages.length }}</v-card-subtitle>
      <v-card-text>
        <div>
          Участники:
          <v-chip-group>
            <v-chip color="primary" :key="user.id" v-for="user in thread.users">
              {{ user.name }}
              <template v-if="user.group">({{ user.group.name }})</template>
              <template v-if="USER.name == user.name">(Вы)</template>
            </v-chip>
          </v-chip-group>
        </div>
      </v-card-text>
    </v-card>

    <v-dialog v-model="threadDialog" width="500">
      <template v-slot:activator="{ on }">
        <v-btn v-on="on" color="primary" fab right bottom fixed>
          <v-icon>add</v-icon>
        </v-btn>
      </template>

      <v-card>
        <v-card-title class="headline primary white--text" primary-title>Новый диалог</v-card-title>

        <v-card-text>
          <form ref="threadForm" id="faculty">
            <v-text-field label="Название" name="name"></v-text-field>
            <v-select
              multiple
              label="Участники"
              chips
              name="users"
              :items="items"
              item-value="id"
              item-text="name"
            ></v-select>
            <v-textarea label="Сообщение" name="text"></v-textarea>
            <v-file-input name="attachments[]" label="Вложения" multiple chips counter></v-file-input>
          </form>
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="primary" text @click="threadDialog = false">Отмена</v-btn>
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
    threadDialog: false,
    loading: false
  }),
  methods: {
    ...mapActions(["FETCH_USERS", "FETCH_THREADS", "STORE_THREAD"]),
    async submit() {
      const formData = new FormData(this.$refs.threadForm);

      this.loading = true;
      await this.STORE_THREAD(formData);
      this.loading = false;

      this.FETCH_THREADS();
      this.threadDialog = false;
    }
  },
  computed: {
    ...mapGetters(["USERS", "USER", "THREADS"]),
    items() {
      let items = [];
      switch (this.USER.role.stub) {
        case "student":
          items = this.USERS.data.filter(u => u.role.stub == "teacher");
          break;
        case "teacher":
          items = this.USERS.data.filter(u => u.role.stub == "student");
          break;
      }

      return items.map(i => {
        if (i.group) {
          i.name = `${i.name} (${i.group.name})`;
        } else {
          return i;
        }
      });
    }
  },
  async mounted() {
    await this.FETCH_USERS();
    await this.FETCH_THREADS();

    console.log(this.THREADS);
  }
};
</script>
