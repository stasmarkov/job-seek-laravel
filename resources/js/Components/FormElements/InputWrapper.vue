<script setup>
import InputLabel from "@/Components/FormElements/InputLabel.vue";
import InputError from "@/Components/FormElements/InputError.vue";

const props = defineProps({
  label: {
    type: String,
    require: false,
  },
  id: {
    type: String,
    require: true,
  },
  message: {
    type: String,
    require: true,
  }

})
</script>

<template>
  <div class="mt-4 flex-1">
    <InputLabel v-if="props.label" :for="props.id" :value="props.label"/>
    <slot />
    <InputError class="mt-2" :message="props.message"/>
  </div>
</template>

