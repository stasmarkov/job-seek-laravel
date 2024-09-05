<script setup>
import {onMounted, ref} from 'vue';

const model = defineModel({
  name: String,
  required: true,
});

const props = defineProps({
  options: [],
  emptyValue: {
    type: String,
    default: '--- Select ---',
  },
});

const input = ref(null);

onMounted(() => {
  if (input.value.hasAttribute('autofocus')) {
    input.value.focus();
  }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
  <select v-model="model" ref="input">
    <option selected disabled value>{{ props.emptyValue }}</option>
    <option v-for="(value, key) in options" :value="key">{{ value }}</option>
  </select>

</template>
