<script setup>

import AdminLayout from "@/Layouts/AdminLayout.vue";
import LinkButton from "@/Components/Buttons/LinkButton.vue";
import Pager from "@/Components/Pagers/Pager.vue";
import Tag from "@/Components/Models/Tags/Tag.vue";

const props = defineProps({
  vacancies: Object,
})
</script>

<template>
  <AdminLayout>
    <Head title="List of vacancies"/>
    <template #heading>List of posted vacancies</template>

    <div class="flex border-b pb-4">
      <LinkButton :href="route('vacancy.create')" class="">Post a new vacancy</LinkButton>
    </div>
    <ul class="divide-y divide-gray-100">
      <li v-for="vacancy in props.vacancies.data" :key="vacancy.id" class="flex justify-between gap-x-6 py-5">
        <div class="flex min-w-0 gap-x-4">
          <div class="min-w-0 flex-auto">
            <p class="mt-1 truncate text-xs leading-5 text-gray-500">
              {{ vacancy.schedule }} | {{ vacancy.salary }}
            </p>
            <p class="text-sm font-semibold leading-6 text-gray-900">
              <Link :href="route('vacancy.show', { vacancy: vacancy.id })" v-if="vacancy.id" class="hover:text-blue-500 hover:underline">{{ vacancy.title }}</Link>
            </p>
            <p class="text-xs font-semibold leading-6 text-gray-500">
              {{ vacancy.short_description }}
            </p>
            <div v-if="vacancy.tags.length" class="flex flex-wrap gap-2 mt-4 basis-full">
              <Tag class="!bg-black" v-for="tag in vacancy.tags" size="small" :tag />
            </div>
          </div>
        </div>
        <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
          <p class="text-sm leading-6 text-gray-900">{{ vacancy.role }}</p>
          <p class="mt-1 text-xs leading-5 text-gray-500">
            Posted: <time :datetime="vacancy.created_at">{{ new Date(vacancy.created_at).getFullYear() }}</time>
          </p>
          <LinkButton class="mt-2 text-xs" :href="route('vacancy.edit', { vacancy: vacancy.id })">Edit</LinkButton>
        </div>
      </li>
    </ul>

    <Pager :links="props.vacancies.links"></Pager>
  </AdminLayout>
</template>

<style scoped>

</style>
