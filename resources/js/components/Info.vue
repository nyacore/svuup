<template>
  <v-card flat outlined>
    <v-card-text>
      <p>Факультет: Атомная энергетика и технологии</p>
      <p>Направление: Информационные системы и технологии</p>
      <p>
        <v-row align="center">
          <v-col cols="4">Семестр:</v-col>
          <v-col cols="3">
            <v-select :items="items" v-model="v"></v-select>
          </v-col>
        </v-row>
      </p>
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  data: () => ({
    v: 1,
    items: [
      {
        value: 1,
        text: "1"
      },
      {
        value: 2,
        text: "2"
      },
      {
        value: 3,
        text: "3"
      },
      {
        value: 4,
        text: "4"
      },
      {
        value: 5,
        text: "5"
      }
    ]
  })
};
</script>
