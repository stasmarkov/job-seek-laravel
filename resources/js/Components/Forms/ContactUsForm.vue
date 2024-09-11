<script setup>

import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";
import InputError from "@/Components/FormElements/InputError.vue";
import InputLabel from "@/Components/FormElements/InputLabel.vue";
import TextareaInput from "@/Components/FormElements/TextareaInput.vue";
import FormGroup from "@/Components/FormElements/FormGroup.vue";
import {useForm} from "@inertiajs/vue3";
import TextInput from "@/Components/FormElements/TextInput.vue";
import {useCurrentUser} from "@/Composables/useCurrentUser.js";

const currentUser = useCurrentUser();

const form = useForm({
  contact_message: '',
  first_name: currentUser?.name,
  last_name: '',
  email: currentUser?.email,
});

// The form submission.
const submit = () => {
  form.post(route('contact.store'), {
    onSuccess: () => form.reset(),
  });
};
</script>

<template>
  <FormGroup class="bg-white/20 border-white rounded-2xl">
    <form @submit.prevent="submit">
        <div class="block border-b mb-4 pb-4">
          <h1 class="text-3xl">Contact Us!</h1>
          <p class="mt-2 font-extralight text-gray-200">Write us about the problem or about your user experience.</p>
        </div>

        <div class="flex gap-4 mt-4 flex-wrap md:flex-nowrap">
          <div class="w-full md:w-1/2">
            <InputLabel for="first_name" class="text-white">First name</InputLabel>
            <TextInput required class="mt-2 w-full text-black" id="first_name"  v-model="form.first_name" />
            <InputError class="mt-2" :message="form.errors.first_name" />
          </div>

          <div class="w-full md:w-1/2">
            <InputLabel for="last_name" class="text-white">Last name</InputLabel>
            <TextInput required class="mt-2 w-full text-black" id="last_name"  v-model="form.last_name" />
            <InputError class="mt-2" :message="form.errors.last_name" />
          </div>
        </div>

        <div class="w-full mt-4">
          <InputLabel for="email" class="text-white">E-mail</InputLabel>
          <TextInput type="email" required class="mt-2 w-full text-black" id="email"  v-model="form.email" />
          <InputError class="mt-2" :message="form.errors.email" />
        </div>

        <div class="mt-4">
          <InputLabel for="contact_message" class="text-white">Message</InputLabel>
          <TextareaInput required class="mt-2 w-full text-black" id="contact_message" rows="4" v-model="form.contact_message" />
          <InputError class="mt-2" :message="form.errors.contact_message" />

        </div>


        <div class="flex items-center gap-4 mt-2">
          <PrimaryButton :disabled="form.processing">Send</PrimaryButton>

          <Transition
            enter-active-class="transition ease-in-out"
            enter-from-class="opacity-0"
            leave-active-class="transition ease-in-out"
            leave-to-class="opacity-0"
          >
            <p v-if="form.recentlySuccessful" class="text-sm text-green-500">Successfully sent.</p>
          </Transition>
        </div>
    </form>
  </FormGroup>
</template>
