<script setup>
import AdminAreaLayout from "@/Layouts/AdminAreaLayout.vue";
</script>

<template>
  <Head title="Dashboard"/>

  <AdminAreaLayout>
    <template #heading>
      <h2 class="text-white font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
    </template>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">You're logged in!</div>
      </div>
    </div>
  </AdminAreaLayout>

</template>
