<script setup>
import AdminAreaLayout from "@/Layouts/AdminAreaLayout.vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";
</script>

<template>
  <Head title="Dashboard"/>

  <AdminLayout>
    <template #heading>
      Dashboard
    </template>

    <div class="p-6 text-gray-900">You're logged in!</div>
  </AdminLayout>
</template>
