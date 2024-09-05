<script setup>

import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";
import InputError from "@/Components/FormElements/InputError.vue";
import InputLabel from "@/Components/FormElements/InputLabel.vue";
import TextareaInput from "@/Components/FormElements/TextareaInput.vue";
import FormGroup from "@/Components/FormElements/FormGroup.vue";
import {useForm} from "@inertiajs/vue3";

const form = useForm({
  contact_message: ''
});

// The form submission.
const submit = () => {
  form.post(route('contact.store'), {
    onFinish: () => {
      form.reset();
    }
  });
};
</script>

<template>
  <form @submit.prevent="submit">
    <FormGroup class="bg-transparent">
      <InputLabel for="contact_message" class="text-xl text-black/80">Write us about the problem!</InputLabel>
      <TextareaInput required class="mt-2 w-full text-black" id="contact_message" rows="4" v-model="form.contact_message" />
      <InputError class="mt-2" :message="form.errors.contact_message" />

      <div class="flex items-center gap-4 mt-2">
        <PrimaryButton :disabled="form.processing">Send</PrimaryButton>

        <Transition
          enter-active-class="transition ease-in-out"
          enter-from-class="opacity-0"
          leave-active-class="transition ease-in-out"
          leave-to-class="opacity-0"
        >
          <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Successfully sent.</p>
        </Transition>
      </div>
    </FormGroup>
  </form>
</template>
