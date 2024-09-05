<script setup>

import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import {useForm} from "@inertiajs/vue3";
import {computed, ref} from "vue";

const form = useForm({});
const query = ref('');
defineEmits(['searchSubmit']);

const doSearch = () => {
  let result = form.get(route('search', {
    q: query.value,
  }));
};

</script>

<template>
  <form @submit.prevent="doSearch" class="mt-6 space-y-6 max-w-96 mx-auto text-gray-900">
    <div>
      <InputLabel for="query" value="Search"/>
      <TextInput
        type="text"
        name="query"
        placeholder="Web Developer..."
        v-model="query"
        class="mt-1 block w-full"
      />
    </div>
  </form>
</template>
