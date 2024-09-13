<script setup>
import Checkbox from '@/Components/FormElements/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/FormElements/InputError.vue';
import InputLabel from '@/Components/FormElements/InputLabel.vue';
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue';
import TextInput from '@/Components/FormElements/TextInput.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';
import BlockHeading from "@/Components/Headings/BlockHeading.vue";
import LinkButton from "@/Components/Buttons/LinkButton.vue";
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";
import {faGithub} from "@fortawesome/free-brands-svg-icons";
import FormHeading from "@/Components/Headings/FormHeading.vue";

defineProps({
  canResetPassword: {
    type: Boolean,
  },
  status: {
    type: String,
  },
});

const form = useForm({
  email: '',
  password: '',
  remember: false,
});

const submit = () => {
  form.post(route('login'), {
    onFinish: () => form.reset('password'),
  });
};
</script>

<template>
  <GuestLayout>
    <Head title="Log in"/>

    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
      {{ status }}
    </div>

    <FormHeading>
      <h1 class="text-2xl">Login using your account</h1>
    </FormHeading>
    <form @submit.prevent="submit" class="mt-4">
      <div>
        <InputLabel for="email" value="Email"/>

        <TextInput
          id="email"
          type="email"
          class="mt-1 block w-full"
          v-model="form.email"
          required
          autofocus
          autocomplete="username"
        />

        <InputError class="mt-2" :message="form.errors.email"/>
      </div>

      <div class="mt-4">
        <div class="flex justify-between">
          <InputLabel for="password" value="Password"/>
          <Link
            v-if="canResetPassword"
            :href="route('password.request')"
            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
          >
            Forgot your password?
          </Link>
        </div>

        <TextInput
          id="password"
          type="password"
          class="mt-1 block w-full"
          v-model="form.password"
          required
          autocomplete="current-password"
        />

        <InputError class="mt-2" :message="form.errors.password"/>
      </div>

      <div class="block mt-4">
        <label class="flex items-center">
          <Checkbox name="remember" v-model:checked="form.remember"/>
          <span class="ms-2 text-sm text-gray-600">Remember me</span>
        </label>
      </div>

      <div class="flex items-center justify-end mt-4 gap-2">
        <a
          :href="route('auth.github')"
          class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
          GitHub
          <font-awesome-icon :icon="faGithub" />
        </a>

        <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
          Log in
        </PrimaryButton>
      </div>

      <div class="mt-4 pt-4 border-t border-gray-200">
        <p class="text-sm text-gray-600">Don’t have an account? <Link
          :href="route('register')"
          class="underline hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
        >
          Create a new account
        </Link></p>
      </div>
    </form>
  </GuestLayout>
</template>
