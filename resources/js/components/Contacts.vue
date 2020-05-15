<template>
  <v-container>
    <v-row justify="space-between">
      <v-col>
        <v-data-table
          :loading="tableLoading"
          :headers="headers"
          :items="LEADS.data"
          :server-items-length="LEADS.total"
          :items-per-page="LEADS.per_page"
          @update:page="updatePage"
          @click:row="openContactsDialog"
          class="elevation-1"
        ></v-data-table>
      </v-col>
      <v-col sm="12" lg="3">
        <v-card>
          <v-card-text>
            <v-text-field label="Поиск по всем значениям"></v-text-field>
            <v-checkbox label="Скрыть прозвоненные"></v-checkbox>
            <multi-select label="Ответственный" :items="responsibles"></multi-select>
            <multi-select label="Теги" :items="TAGS"></multi-select>
            <v-select label="Выберите сценарий" :items="SCENARIOS"></v-select>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
    <v-dialog scrollable max-width="500" v-model="contactsDialog">
      <v-tabs flat v-model="tab">
        <v-tabs-slider></v-tabs-slider>

        <v-tab v-for="tab in tabs" :key="tab.value" :href="`#${tab.value}`">{{ tab.title }}</v-tab>
        <v-tab-item value="information">
          <v-card class="flexcard" min-height="300">
            <v-card-subtitle>Название организации: {{ selectedContact.name }}</v-card-subtitle>
            <v-card-text class="grow">
              <v-row class="font-regular">
                <v-col cols="6">
                  <p>Деятельность: {{ selectedContact.activity }}</p>
                  <p>Адрес: {{ selectedContact.address }}</p>
                  <p>Телефон: {{ selectedContact.phones }}</p>
                  <p>Email: {{ selectedContact.emails }}</p>
                </v-col>
                <v-col cols="6">
                  <p>Город: {{ selectedContact.city }}</p>
                  <p>Регион: {{ selectedContact.region }}</p>
                  <p>Сайт: {{ selectedContact.sites }}</p>
                  <p>Теги: {{ selectedContact.tags }}</p>
                </v-col>
              </v-row>
            </v-card-text>
            <v-divider></v-divider>
            <v-btn
              color="primary"
              text
              link
              :to="{name: 'leads.show', params: { id: selectedContact.id}}"
            >Перейти в карточку организации</v-btn>
          </v-card>
        </v-tab-item>
        <v-tab-item value="contacts">
          <v-card class="flexcard" min-height="300">
            <!-- <v-card-subtitle>Название организации: {{ selectedContact.name }}</v-card-subtitle> -->
            <v-card-text class="grow">
              <v-simple-table>
                <template v-slot:default>
                  <thead>
                    <tr>
                      <th class="text-left">Имя</th>
                      <th class="text-left">Email</th>
                      <th class="text-left">Телефон</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="contact in contacts" :key="contact.name">
                      <td>{{ contact.name }}</td>
                      <td>{{ contact.email }}</td>
                      <td>
                        <v-btn color="primary">{{ contact.phone }}</v-btn>
                      </td>
                    </tr>
                  </tbody>
                </template>
              </v-simple-table>
            </v-card-text>
            <v-divider></v-divider>
            <v-btn
              color="primary"
              text
              link
              :to="{name: 'leads.show', params: { id: selectedContact.id}}"
            >Перейти в карточку организации</v-btn>
          </v-card>
        </v-tab-item>
      </v-tabs>
    </v-dialog>
  </v-container>
</template>

<script>
import MultiSelect from "./ui/MultiSelect";

import { mapGetters, mapActions } from "vuex";

export default {
  components: {
    "multi-select": MultiSelect
  },
  data: () => ({
    contacts: [
      {
        name: "Контакт 1",
        email: "mail@mail.ru",
        phone: "+7 (927) 627-10-75"
      },
      {
        name: "Контакт 2",
        email: "mail@rambler.ru",
        phone: "+7 (927) 627-10-75"
      },
      {
        name: "Контакт 3",
        email: "mail@google.com",
        phone: "+7 (927) 627-10-75"
      },
      {
        name: "Контакт 4",
        email: "mail@yandex.ru",
        phone: "+7 (927) 627-10-75"
      }
    ],
    tableLoading: true,
    contactsDialog: false,
    selectedContact: {},
    callScenario: "",
    tags: [],
    responsibles: ["Без ответственного"],
    tabs: [
      {
        title: "Информация",
        value: "information"
      },
      {
        title: "Контакты",
        value: "contacts"
      },
      {
        title: "История",
        value: "history"
      },
      {
        title: "События",
        value: "events"
      }
    ],
    headers: [
      {
        text: "Клиент",
        align: "start",
        sortable: false,
        value: "name"
      },
      {
        text: "Последний звонок",
        value: "last_call_at"
      },
      {
        text: "Ответственный",
        value: "responsible"
      }
    ]
  }),
  async mounted() {
    await this.FETCH_SCENARIOS();
    this.callScenario = this.SCENARIOS[0];

    await this.FETCH_LEADS();
    this.tableLoading = false;

    this.FETCH_TAGS();
  },
  computed: {
    ...mapGetters(["SCENARIOS", "TAGS", "LEADS"])
  },
  methods: {
    ...mapActions(["FETCH_SCENARIOS", "FETCH_TAGS", "FETCH_LEADS"]),
    async updatePage(page) {
      this.tableLoading = true;
      await this.FETCH_LEADS(page);
      this.tableLoading = false;
    },
    openContactsDialog(e) {
      this.selectedContact = e;
      this.contactsDialog = true;
    }
  }
};
</script>

<style>
.flexcard {
  display: flex;
  flex-direction: column;
}
</style>
