<script setup>

import TextInput from "@/Components/FormElements/TextInput.vue";
import {useForm} from "@inertiajs/vue3";

// The default value or the search input.
const props = defineProps({
  searchString: String,
});

// The form values.
const form = useForm({
  search: props.searchString
});

// List of events.
defineEmits(['searchFormSubmitEvent']);
</script>

<template>
  <h1 class="font-bold text-4xl">Let's Find Your Next Job</h1>
  <form class="mt-6 space-y-6 max-w-96 mx-auto text-gray-900">
    <div>
      <TextInput
        type="search"
        name="search"
        placeholder="Web Developer..."
        v-model="form.search"
        class="mt-1 block w-full"
        @keyup="$emit('searchFormSubmitEvent', form.search)"
      />
    </div>
  </form>
</template>
