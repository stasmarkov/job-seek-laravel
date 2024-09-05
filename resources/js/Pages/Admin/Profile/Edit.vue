<script setup>
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import {Head, usePage} from '@inertiajs/vue3';
import AdminAreaLayout from "@/Layouts/AdminAreaLayout.vue";
import LinkButton from "@/Components/Buttons/LinkButton.vue";

defineProps({
  mustVerifyEmail: {
    type: Boolean,
  },
  status: {
    type: String,
  },
});

</script>

<template>
  <Head title="Profile"/>
  <AdminAreaLayout>
    <template #heading>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Profile</h2>
    </template>

    <template #default>
      <div v-if="$page.props.employer.id" class="flex gap-2">
        <LinkButton :href="route('employer.edit', {'employer': $page.props.employer.id })">Edit Employer information</LinkButton>
      </div>

      <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <UpdateProfileInformationForm
          :must-verify-email="mustVerifyEmail"
          :status="status"
          class="max-w-xl"
        />
      </div>

      <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <UpdatePasswordForm class="max-w-xl"/>
      </div>

      <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <DeleteUserForm class="max-w-xl"/>
      </div>
    </template>
  </AdminAreaLayout>
</template>
