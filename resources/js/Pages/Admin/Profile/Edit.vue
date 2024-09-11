<script setup>
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import {Head} from '@inertiajs/vue3';
import LinkButton from "@/Components/Buttons/LinkButton.vue";
import FormGroup from "@/Components/FormElements/FormGroup.vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";

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
  <AdminLayout>
    <template #heading>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Profile</h2>
    </template>

    <template #default>
      <div v-if="$page.props.employer?.id" class="flex gap-2">
        <LinkButton :href="route('employer_profile.edit', {'employerProfile': $page.props.employerProfile.id })">Edit Employer information</LinkButton>
      </div>

      <FormGroup class="mt-4">
        <UpdateProfileInformationForm
          :must-verify-email="mustVerifyEmail"
          :status="status"
          class="max-w-xl"
        />
      </FormGroup>

      <FormGroup class="mt-4">
        <UpdatePasswordForm class="max-w-xl"/>
      </FormGroup>

      <FormGroup class="mt-4">
        <DeleteUserForm class="max-w-xl"/>
      </FormGroup>
    </template>
  </AdminLayout>
</template>
