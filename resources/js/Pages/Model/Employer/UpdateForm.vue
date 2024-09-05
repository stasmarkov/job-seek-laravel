<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {Link, useForm, usePage} from '@inertiajs/vue3';
import AdminAreaLayout from "@/Layouts/AdminAreaLayout.vue";
import LinkButton from "@/Components/Buttons/LinkButton.vue";

const props = defineProps({
  employer: {
    type: Object,
  },
});

const user = usePage().props.auth.user;

const form = useForm({
  name: props.employer.name,
});

</script>

<template>
  <AdminAreaLayout>
    <template #heading>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit employer</h2>
    </template>


    <template #default>
      <div v-if="user" class="flex gap-2">
        <LinkButton :href="route('profile.edit')">Edit profile</LinkButton>
      </div>

      <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <header>
          <h2 class="text-lg font-medium text-gray-900">Employer Information</h2>

          <p class="mt-1 text-sm text-gray-600">
            Update your employer's profile information.
          </p>
        </header>

        <form @submit.prevent="form.patch(route('employer.update', { employer: employer.id }))" class="mt-6 space-y-6">
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

          <div>
<!--            <InputLabel for="email" value="Email"/>-->

<!--            <TextInput-->
<!--              id="email"-->
<!--              type="email"-->
<!--              class="mt-1 block w-full"-->
<!--              v-model="form.email"-->
<!--              required-->
<!--              autocomplete="username"-->
<!--            />-->

<!--            <InputError class="mt-2" :message="form.errors.email"/>-->
          </div>

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

  </AdminAreaLayout>
</template>
