<script setup>

import {ref} from "vue";

const props = defineProps({
  items: Array,
  selectedItems: Array,
  type: String,
});

defineEmits(['checkboxCheckedEvent']);

const selectedItems = ref(props?.selectedItems ?? []);

</script>

<template>
  <div class="flex flex-wrap gap-2 p-4" :class="{
    'bg-black': props?.type === 'admin'
  }">
     <span v-for="item in items">
      <input
        @change="$emit('checkboxCheckedEvent', selectedItems)"
        type="checkbox" :id="item.id" :value="item.id" v-model="selectedItems" class="hidden"/>
      <label
        :for="item.id"
        class="hover:cursor-pointer rounded-2xl font-bold transition-colors duration-300 text-white px-5 py-1 text-sm"
        :class="{
          'bg-blue-500 hover:bg-blue-400' : selectedItems.map(el => el.toString()).includes(item.id.toString()),
          'bg-white/10 hover:bg-white/25' : !selectedItems.map(el => el.toString()).includes(item.id.toString()),
        }"
      >{{ item.name }}</label>
    </span>
  </div>
</template>
