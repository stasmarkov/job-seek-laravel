<script setup>

import TextInput from "@/Components/FormElements/TextInput.vue";
import {useForm} from "@inertiajs/vue3";
import SecondaryButton from "@/Components/Buttons/SecondaryButton.vue";
import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";

// The default value or the search input.
const props = defineProps({
  searchString: String,
  type: String,
  title: {
    type: String,
    default: 'Let\'s find Your next Opportunity'
  }
});

// The form values.
const form = useForm({
  search: props.searchString
});

// List of events.
defineEmits(['searchFormSubmitEvent']);
</script>

<template>
  <h1 class="font-bold text-4xl">{{ props.title }}</h1>
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
        type="text"
        name="search"
        placeholder="Web Developer..."
        v-model="form.search"
        class="block w-full"
      />
      <PrimaryButton
        v-if="props.searchString && props.searchString.length && props.type === 'keyup'"
        @click="() => {form.search = null; $emit('searchFormSubmitEvent', {})}"
      >
        Reset
      </PrimaryButton>
    </div>
  </form>
</template>
