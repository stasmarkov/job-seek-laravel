<script setup>

import GuestLayout from "@/Layouts/GuestLayout.vue";
import RoleSelectForm from "@/Components/Forms/RoleSelectForm.vue";
</script>

<template>
  <Head title="Dashboard"/>

  <GuestLayout class="">
    <h1 class="text-xl text-center mb-4">Before we start, please select your role:</h1>
    <RoleSelectForm />
  </GuestLayout>
</template>
