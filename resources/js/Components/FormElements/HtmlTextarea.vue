<script setup>
import { quillEditor } from 'vue3-quill'

const model = defineModel({
  type: String,
  required: true,
});

</script>

<template>
  <textarea class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm w-full" rows="5" v-model="model"></textarea>
</template>

<style scoped>

</style>
