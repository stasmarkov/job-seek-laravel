<script setup>

import AdminLayout from "@/Layouts/AdminLayout.vue";
import LinkButton from "@/Components/Buttons/LinkButton.vue";
import Pager from "@/Components/Pager.vue";
import Tag from "@/Components/Tags/Tag.vue";

const props = defineProps({
  loginLogs: Object,
})
</script>

<template>
  <AdminLayout>
    <Head title="List of Login logs"/>
    <template #heading>List of Login logs</template>

    <table class="w-full">
      <thead>
      <tr>
        <th class="text-left p-2">ID</th>
        <th class="text-left p-2">Date</th>
        <th class="text-left p-2">IP</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="log in props.loginLogs" class="border-t">
        <td class="p-2">{{ log.id }}</td>
        <td class="p-2">{{ log.created_at }}</td>
        <td class="p-2">{{ log.ip }}</td>
      </tr>
      </tbody>
    </table>

    <!--    <div class="flex pt-4 border-t justify-center px-2">-->
    <!--      <Pager :links="props.jobs.links"></Pager>-->
    <!--    </div>-->
  </AdminLayout>
</template>

<style scoped>

</style>
