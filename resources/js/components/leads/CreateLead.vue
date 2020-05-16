<template>
  <v-container fluid class="fill-height">
    <v-row class="fill-height">
      <v-col cols="4">
        <v-card class="fill-height" flat>
          <v-card-title>Новая организация</v-card-title>

          <v-divider></v-divider>

          <v-card-text class="fill-height" style="overflow-y: scroll; max-height: 70vh">
            <form @submit.prevent="submit">
              <v-text-field v-model="lead.name" label="Название" name="name"></v-text-field>
              <v-text-field
                dense
                v-model="lead.phones"
                prepend-icon="phone"
                label="Телефон"
                name="phones"
              ></v-text-field>
              <v-text-field
                dense
                v-model="lead.emails"
                prepend-icon="email"
                label="Email"
                name="emails"
              ></v-text-field>
              <v-text-field dense v-model="lead.sites" prepend-icon="web" label="Сайт" name="sites"></v-text-field>
              <v-text-field
                dense
                v-model="lead.city"
                prepend-icon="location_city"
                label="Город"
                name="city"
              ></v-text-field>
              <v-text-field dense v-model="lead.street" label="Адрес" name="address"></v-text-field>
              <v-text-field dense v-model="lead.region" label="Регион" name="region"></v-text-field>
              <v-text-field
                dense
                v-model="lead.activity"
                label="Сфера деятельности"
                name="activity"
              ></v-text-field>
              <v-text-field dense v-model="lead.INN" label="ИНН" name="INN"></v-text-field>
              <v-text-field dense v-model="lead.KPP" label="КПП" name="KPP"></v-text-field>
              <multi-select v-model="lead.tags" :items="TAGS" label="Теги"></multi-select>
              <v-textarea dense v-model="lead.desc" name="description" label="Описание" rows="2"></v-textarea>
              <v-text-field
                dense
                v-model="lead.responsible"
                label="Ответственный"
                name="responsible"
              ></v-text-field>
            </form>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn exact text :to="{ name: 'leads' }">Отмена</v-btn>
            <v-btn @click="submit" color="primary">Сохранить</v-btn>
          </v-card-actions>
        </v-card>
      </v-col>
      <v-col>
        <v-divider vertical cols="1"></v-divider>
      </v-col>
      <v-col cols="7"></v-col>
    </v-row>
  </v-container>
</template>

<script>
import MultiSelect from "../ui/MultiSelect";
import { mapGetters, mapActions } from "vuex";

export default {
  data: () => ({
    lead: {
      name: "",
      phones: "",
      emails: "",
      sites: "",
      city: "",
      street: "",
      region: "",
      activity: "",
      INN: "",
      KPP: "",
      tags: "",
      desc: "",
      responsible: ""
    }
  }),
  components: {
    "multi-select": MultiSelect
  },
  async mounted() {
    this.FETCH_TAGS();
  },
  methods: {
    ...mapActions(["FETCH_TAGS", "STORE_LEAD"]),
    submit(e) {
      this.STORE_LEAD(this.lead);
    }
  },
  computed: {
    ...mapGetters(["TAGS"])
  }
};
</script>

<style scoped>
</style>
