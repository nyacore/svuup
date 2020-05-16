<template>
  <v-card>
    <v-card-title>
      <span class="headline">{{ title }}</span>
    </v-card-title>

    <v-card-text>
      <v-container>
        <v-row>
          <v-datetime-picker
            label="Дата и время"
            v-model="dateTime"
            :time-picker-props="{ format: '24hr' }"
          >
            <template slot="actions" slot-scope="{ parent }">
              <v-btn text @click.native="parent.clearHandler">Отмена</v-btn>
              <v-btn color="primary" @click="parent.okHandler">Сохранить</v-btn>
            </template>
          </v-datetime-picker>
        </v-row>
      </v-container>
    </v-card-text>

    <v-card-actions>
      <v-spacer></v-spacer>
      <v-btn text @click="$emit('cancel')">Отменить</v-btn>
      <v-btn color="primary" @click="$emit('submit')">Сохранить</v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
export default {
  props: {
    task: {
      type: Object,
      required: true
    },
    title: {
      type: String,
      required: true
    }
  },
  data: () => ({
    timePicker: false,
    datePicker: false,
    dateTime: ""
  }),
  methods: {
    dateChanged(e) {
      console.log(e);
    }
  }
};
</script>
