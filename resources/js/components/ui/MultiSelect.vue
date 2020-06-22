<template>
  <v-select dense :label="label" :items="items" v-model="value" multiple chips>
    <template v-slot:prepend-item>
      <v-list-item ripple @click="toggle">
        <v-list-item-action>
          <v-icon :color="items.length > 0 ? 'primary' : ''">{{ icon }}</v-icon>
        </v-list-item-action>
        <v-list-item-content>
          <v-list-item-title>Выбрать все</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
      <v-divider class="mt-2"></v-divider>
    </template>
  </v-select>
</template>

<script>
export default {
  name: "MultiSelect",
  props: {
    items: {
      type: Array,
      required: true
    },
    label: {
      type: String,
      default: "Выберите несколько"
    }
  },
  data: () => ({
    selectedItems: []
  }),
  methods: {
    toggle() {
      if (this.selectedItems.length > 0) {
        this.selectedItems = [];
      } else if (this.selectedItems.length === 0) {
        this.selectedItems = this.items;
      }
    }
  },
  computed: {
    value: {
      get() {
        return this.selectedItems;
      },

      set(value) {
        this.selectedItems = value;

        this.$emit("change", this.selectedItems);
      }
    },
    someItems() {
      return this.selectedItems.length > 0;
    },
    allItems() {
      return this.selectedItems.length === this.items.length;
    },
    icon() {
      if (this.allItems) {
        return "check_box";
      } else if (this.someItems) {
        return "indeterminate_check_box";
      } else {
        return "check_box_outline_blank";
      }
    }
  }
};
</script>
