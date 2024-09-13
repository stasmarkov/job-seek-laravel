<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/FormElements/InputError.vue';
import InputLabel from '@/Components/FormElements/InputLabel.vue';
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue';
import TextInput from '@/Components/FormElements/TextInput.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';
import Divider from "@/Components/FormElements/Divider.vue";
import SelectInput from "@/Components/FormElements/SelectInput.vue";
import InputWrapper from "@/Components/FormElements/InputWrapper.vue";
import InputDescription from "@/Components/FormElements/InputDescription.vue";
import {faGithub} from "@fortawesome/free-brands-svg-icons";
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";

const form = useForm({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
});

const submit = () => {
  form.post(route('register'), {
    onFinish: () => form.reset('password', 'password_confirmation'),
  }, {
    forceFormData: true,
  });
};
</script>

<template>
  <GuestLayout>
    <Head title="Register"/>

    <form @submit.prevent="submit">
      <InputWrapper id="name" label="Username" :message="form.errors.name">
        <TextInput
          id="name"
          type="text"
          class="mt-1 block w-full"
          v-model="form.name"
          required
          autofocus
          autocomplete="name"
          placeholder="Name..."
        />
      </InputWrapper>


      <InputWrapper id="email" label="Email" :message="form.errors.email">
        <TextInput
          id="email"
          type="email"
          class="mt-1 block w-full"
          v-model="form.email"
          required
          autocomplete="username"
          placeholder="example@mail.com"
        />
        <InputDescription>
          All emails from the system will be sent to this address. The email address is not made public and will only be used if you wish to receive a new password or wish to receive certain news or notifications by email.
        </InputDescription>
      </InputWrapper>

      <InputWrapper id="password" label="Password" :message="form.errors.password">
        <TextInput
          id="password"
          type="password"
          class="mt-1 block w-full"
          v-model="form.password"
          required
          autocomplete="new-password"
        />
      </InputWrapper>

      <InputWrapper id="password_confirmation" label="Confirm Password" :message="form.errors.password_confirmation">
        <TextInput
          id="password_confirmation"
          type="password"
          class="mt-1 block w-full"
          v-model="form.password_confirmation"
          required
          autocomplete="new-password"
        />
      </InputWrapper>

      <Divider/>

      <div class="flex items-center justify-end mt-4 gap-2">
        <Link
          :href="route('login')"
          class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
        >
          Already registered?
        </Link>
        <a
          :href="route('auth.github')"
          class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
          GitHub
          <font-awesome-icon :icon="faGithub" />
        </a>
        <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
          Register
        </PrimaryButton>
      </div>
    </form>
  </GuestLayout>
</template>
