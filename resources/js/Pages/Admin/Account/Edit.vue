<script setup>
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import {Head} from '@inertiajs/vue3';
import LinkButton from "@/Components/Buttons/LinkButton.vue";
import FormGroup from "@/Components/FormElements/FormGroup.vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";

const props = defineProps({
  mustVerifyEmail: {
    type: Boolean,
  },
  status: {
    type: String,
  },
  user: {
    type: Object,
    required: true,
  },
  candidateProfile: Object,
  employerProfile: Object,
});

</script>

<template>
  <Head title="Profile"/>
  <AdminLayout>
    <template #heading>
      <h2 class="font-light text-xl text-gray-800 leading-tight"><span class="font-semibold">{{ props.user.data.name }}</span> account</h2>
    </template>

    <template #default>
      <div v-if="props.employerProfile" class="flex gap-2">
        <LinkButton :href="route('profile.employer.edit', {'user': props.user.data.id })">Profile</LinkButton>
      </div>

      <div v-if="!props.candidateProfile" class="flex gap-2">
        <LinkButton :href="route('profile.candidate.create', {'user': props.user.data.id })">Profile</LinkButton>
      </div>
      <div v-if="props.candidateProfile" class="flex gap-2">
        <LinkButton :href="route('profile.candidate.edit', {'user': props.user.data.id })">Profile</LinkButton>
      </div>

      <FormGroup class="mt-4">
        <UpdateProfileInformationForm
          :must-verify-email="mustVerifyEmail"
          :status="status"
          :user="props.user.data"
          class="max-w-xl"
        />
      </FormGroup>

      <FormGroup
        class="mt-4"
        v-if="props.user.data.id === $page.props.auth.user.id"
      >
        <UpdatePasswordForm
          class="max-w-xl"
          :user="props.user.data"
        />
      </FormGroup>

      <FormGroup class="mt-4">
        <DeleteUserForm
          class="max-w-xl"
          :user="props.user.data"
        />
      </FormGroup>
    </template>
  </AdminLayout>
</template>
