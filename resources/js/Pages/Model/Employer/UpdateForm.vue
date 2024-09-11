<script setup>
import InputError from '@/Components/FormElements/InputError.vue';
import InputLabel from '@/Components/FormElements/InputLabel.vue';
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue';
import TextInput from '@/Components/FormElements/TextInput.vue';
import {Link, useForm, usePage} from '@inertiajs/vue3';
import LinkButton from "@/Components/Buttons/LinkButton.vue";
import EmployerProfileLogo from "@/Components/Models/Employers/EmployerProfileLogo.vue";
import {useCurrentUser} from "@/Composables/useCurrentUser.js";
import AdminLayout from "@/Layouts/AdminLayout.vue";

const props = defineProps({
  user: {
    type: Object,
  },
  employerProfile: {
    type: Object,
  },
});

const form = useForm({
  name: props.employerProfile?.name,
  logo: props.employerProfile?.logo,
});

</script>

<template>
  <AdminLayout>
    <template #heading>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit employer profile</h2>
    </template>

    <template #default>
      <div v-if="user.id" class="flex gap-2 mb-4">
        <LinkButton :href="route('account.edit', { user: props.user.id })">Edit account</LinkButton>
      </div>

      <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <header>
          <h2 class="text-lg font-medium text-gray-900">Edit Employer Profile</h2>

          <p class="mt-1 text-sm text-gray-600">
            Update your employer's profile information.
          </p>
        </header>

        <form @submit.prevent="form.patch(route('profile.update', { user: props.user.id }))" class="mt-6 space-y-6">
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

          <EmployerProfileLogo v-if="employerProfile" :employerProfile="employerProfile" />

          <div class="flex items-center gap-4">
            <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

            <Transition
              enter-active-class="transition ease-in-out"
              enter-from-class="opacity-0"
              leave-active-class="transition ease-in-out"
              leave-to-class="opacity-0"
            >
              <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
            </Transition>
          </div>
        </form>
      </div>

    </template>
  </AdminLayout>
</template>
