<template>
  <v-card>
    <v-card-title>
      <span class="headline">{{ title }}</span>
    </v-card-title>

    <v-card-text>
      <v-container>
        <v-row>
          <!-- <v-menu
            v-model="datePicker"
            :close-on-content-click="false"
            :nudge-right="40"
            transition="scale-transition"
            offset-y
            min-width="290px"
          >
            <template v-slot:activator="{ on }">
              <v-text-field v-model="date" readonly label="Дата" prepend-icon="event" v-on="on"></v-text-field>
            </template>
            <v-date-picker v-model="date" @input="datePicker = false"></v-date-picker>
          </v-menu>
          <v-menu
            ref="menu"
            v-model="timePicker"
            :close-on-content-click="false"
            :nudge-right="40"
            :return-value.sync="time"
            transition="scale-transition"
            offset-y
            max-width="290px"
            min-width="290px"
          >
            <template v-slot:activator="{ on }">
              <v-text-field
                v-model="time"
                label="Время"
                prepend-icon="access_time"
                readonly
                v-on="on"
              ></v-text-field>
            </template>
            <v-time-picker
              v-if="timePicker"
              v-model="time"
              full-width
              @click:minute="$refs.menu.save(time)"
            ></v-time-picker>
          </v-menu>-->
        </v-row>
      </v-container>
    </v-card-text>

    <v-card-actions>
      <v-spacer></v-spacer>
      <v-btn color="blue darken-1" text @click="$emit('cancel')">Cancel</v-btn>
      <v-btn color="blue darken-1" text @click="$emit('submit')">Save</v-btn>
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
  },
  computed: {
    date: {
      get() {
        return new Date(this.task.date).toISOString();
      },
      set(value) {
        this.task.date = new Date();
      }
    },
    time: {
      get() {
        return new Date(this.task.date).toLocaleTimeString();
      },
      set(value) {
        console.log(value);
      }
    }
  }
};
</script>
