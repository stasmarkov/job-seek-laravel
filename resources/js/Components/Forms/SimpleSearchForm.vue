<script setup>

import TextInput from "@/Components/FormElements/TextInput.vue";
import {useForm} from "@inertiajs/vue3";
import SecondaryButton from "@/Components/Buttons/SecondaryButton.vue";

// The default value or the search input.
const props = defineProps({
  searchString: String,
  type: String,
});

// The form values.
const form = useForm({
  search: props.searchString
});

// List of events.
defineEmits(['searchFormSubmitEvent']);
</script>

<template>
  <h1 class="font-bold text-4xl">Let's Find Your Next vacancy</h1>
  <form
    v-on="
      props.type === 'submit' ? { submit: () => $emit('searchFormSubmitEvent', form.search) } : {}
    "
    class="mt-6 space-y-6 max-w-96 mx-auto text-gray-900"
  >
    <div class="flex gap-2">
      <TextInput
        v-on="
          props.type === 'keyup' ? { keyup: () => $emit('searchFormSubmitEvent', form.search) } : {}
        "
        type="search"
        name="search"
        placeholder="Web Developer..."
        v-model="form.search"
        class="mt-1 block w-full"
      />
      <SecondaryButton
        v-if="props.searchString && props.searchString.length && props.type === 'keyup'"
        @click="() => {form.search = null; $emit('searchFormSubmitEvent', {})}"
      >
        Reset
      </SecondaryButton>
    </div>
  </form>
</template>
