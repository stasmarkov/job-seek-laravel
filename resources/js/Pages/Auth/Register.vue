<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';
import Divider from "@/Components/Divider.vue";

const form = useForm({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
  employer: '',
  logo: '',
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
      <div>
        <InputLabel for="name" value="Name"/>

        <TextInput
          id="name"
          type="text"
          class="mt-1 block w-full"
          v-model="form.name"
          required
          autofocus
          autocomplete="name"
        />

        <InputError class="mt-2" :message="form.errors.name"/>
      </div>

      <div class="mt-4">
        <InputLabel for="email" value="Email"/>

        <TextInput
          id="email"
          type="email"
          class="mt-1 block w-full"
          v-model="form.email"
          required
          autocomplete="username"
        />

        <InputError class="mt-2" :message="form.errors.email"/>
      </div>

      <div class="mt-4">
        <InputLabel for="password" value="Password"/>

        <TextInput
          id="password"
          type="password"
          class="mt-1 block w-full"
          v-model="form.password"
          required
          autocomplete="new-password"
        />

        <InputError class="mt-2" :message="form.errors.password"/>
      </div>

      <div class="mt-4">
        <InputLabel for="password_confirmation" value="Confirm Password"/>

        <TextInput
          id="password_confirmation"
          type="password"
          class="mt-1 block w-full"
          v-model="form.password_confirmation"
          required
          autocomplete="new-password"
        />

        <InputError class="mt-2" :message="form.errors.password_confirmation"/>
      </div>

      <Divider/>

      <div class="mt-4">
        <InputLabel for="employer" value="Employer name"/>

        <TextInput
          id="employer"
          class="mt-1 block w-full"
          v-model="form.employer"
          required
        />
        <InputError class="mt-2" :message="form.errors.employer"/>

      </div>
      <div class="mt-4">
        <InputLabel for="employer" value="Employer logo"/>

        <input
          id="logo"
          class="mt-1 block w-full"
          required
          type="file"
          @input="form.logo = $event.target.files[0]"
        />
        <InputError class="mt-2" :message="form.errors.logo"/>
        <progress v-if="form.progress" :value="form.progress.percentage" max="100">
          {{ form.progress.percentage }}%
        </progress>
      </div>

      <div class="flex items-center justify-end mt-4">
        <Link
          :href="route('login')"
          class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
        >
          Already registered?
        </Link>

        <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
          Register
        </PrimaryButton>
      </div>
    </form>
  </GuestLayout>
</template>
