<script setup>

import AdminLayout from "@/Layouts/AdminLayout.vue";
import LinkButton from "@/Components/Buttons/LinkButton.vue";
import Pager from "@/Components/Pager.vue";

const props = defineProps({
  jobs: Object,
})
</script>

<template>
  <AdminLayout>
    <Head title="List of jobs"/>
    <template #heading>List of posted jobs</template>

    <div class="flex border-b pb-4">
      <LinkButton :href="route('job.create')" class="">Post a new job</LinkButton>
    </div>
    <ul class="divide-y divide-gray-100">
      <li v-for="job in props.jobs.data" :key="job.id" class="flex justify-between gap-x-6 py-5">
        <div class="flex min-w-0 gap-x-4">
          <div class="min-w-0 flex-auto">
            <p class="mt-1 truncate text-xs leading-5 text-gray-500">
              <time :datetime="job.created_at">{{ new Date(job.created_at).getFullYear() }}</time>
            </p>
            <p class="text-sm font-semibold leading-6 text-gray-900">
              <Link :href="route('job.show', {job: job.id})" class="hover:text-blue-500 hover:underline">{{ job.title }}</Link>
            </p>
          </div>
        </div>
        <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
          <p class="text-sm leading-6 text-gray-900">{{ job.role }}</p>
          <p class="mt-1 text-xs leading-5 text-gray-500">
            Posted: <time :datetime="job.created_at">{{ new Date(job.created_at).getFullYear() }}</time>
          </p>
        </div>
      </li>
    </ul>

    <div class="flex pt-4 border-t justify-center px-2">
      <Pager :links="props.jobs.links"></Pager>
    </div>
  </AdminLayout>
</template>

<style scoped>

</style>
