<script setup>
import { quillEditor } from 'vue3-quill'

const model = defineModel({
  type: String,
  required: true,
});

</script>

<template>
  <textarea rows="5" v-model="model"></textarea>
</template>

<style scoped>
  .tox.tox-tinymce {
    border-radius: 0;
    border-width: 1px;
  }
</style>
