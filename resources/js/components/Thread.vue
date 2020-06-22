<template>
  <v-container>
    <v-subheader>Тема: {{ THREADS.data[0].name }}</v-subheader>
    <v-card class="mb-5" v-for="message in THREADS.data[0].messages.reverse()" :key="message.id">
      <v-card-subtitle>От: {{ message.from.name }}</v-card-subtitle>
      <v-card-text>
        <div>Дата написания: {{ new Date(message.created_at).toLocaleString() }}</div>
        <div>Текст: {{ message.text }}</div>
        <div v-if="message.attachments.length">
          Вложения:
          <div v-for="attachment in message.attachments" :key="attachment.id">
            <a :href="`/${attachment.url}`">{{ attachment.url.split('/').pop() }}</a>
          </div>
        </div>
      </v-card-text>
    </v-card>
    <form ref="messageForm">
      <v-textarea name="text" label="Новое сообщение"></v-textarea>
      <v-file-input name="attachments[]" label="Вложения" multiple chips counter></v-file-input>
      <v-btn :loading="loading" color="primary" @click="submit">Отправить</v-btn>
      <input type="hidden" name="thread_id" :value="$route.params.thread" />
    </form>
  </v-container>
</template>
<script>
import { mapActions, mapGetters } from "vuex";
export default {
  data: () => ({
    loading: false
  }),
  computed: {
    ...mapGetters(["THREADS"])
  },
  methods: {
    ...mapActions(["FETCH_THREAD", "STORE_MESSAGE"]),
    async submit() {
      const formData = new FormData(this.$refs.messageForm);

      this.loading = true;
      await this.STORE_MESSAGE(formData);
      this.loading = false;

      this.FETCH_THREAD(this.$route.params.thread);
    }
  },
  async mounted() {
    await this.FETCH_THREAD(this.$route.params.thread);
  }
};
</script>
