<script setup>

import Editor from "@tinymce/tinymce-vue";
const tineMceKey = import.meta.env.TINY_MCE_KEY || '2loran4zkws59gpuschwuf291kpunuc2dzrgtlarjfvh9el8';

const model = defineModel({
  type: String,
  required: true,
});

</script>

<template>
  <Editor
    :api-key="tineMceKey"
    v-model="model"
    class="textarea--html"
    :init="{
        toolbar_mode: 'sliding',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage advtemplate mentions tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss markdown',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        tinycomments_mode: 'embedded',
  }"
  initial-value="Welcome to TinyMCE!"
  />
</template>

<style scoped>
  .textarea--html {
    border-radius: 0;
  }
</style>
