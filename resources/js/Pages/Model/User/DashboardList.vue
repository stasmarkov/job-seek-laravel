<script setup>

import AdminLayout from "@/Layouts/AdminLayout.vue";
import Th from "@/Components/Table/Th.vue";
import Pager from "@/Components/Pagers/Pager.vue";

const props = defineProps({
  users: Object,
})
</script>

<template>
  <AdminLayout>
    <div>
      <div class="flex flex-col">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
          <div
            class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
            <table class="min-w-full">
              <thead>
              <tr>
                <Th label="Name" value="name" :canSort="true" :sortField="$sortField" :sortAsc="$sortAsc"/>
                <Th label="Status" value="status" :canSort="false" :sortField="$sortField" :sortAsc="$sortAsc"/>
                <Th label="Role" value="role" :canSort="true" :sortField="$sortField" :sortAsc="$sortAsc"/>
                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50">
                  <span class="flex rounded-md justify-end">
                      <Link :href="route('homepage')" type="button"
                         class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs leading-4 font-medium rounded text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
                          Add user
                      </Link>
                  </span>
                </th>
              </tr>
              </thead>
              <tbody class="bg-white">
              <tr v-for="user in props.users.data">
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                  <div class="flex items-center">
                    <div class="flex-shrink-0 h-10 w-10">
                      <img class="h-10 w-10 rounded-full"
                           :src="user.avatar"
                           alt="">
                    </div>
                    <div class="ml-4">
                      <div class="flex items-baseline gap-2">
                        <span class="text-sm leading-5 font-medium text-gray-900">{{ user.name }}</span>
                      </div>
                      <div class="text-sm leading-5 text-gray-500">{{ user.email }}</div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                  <span v-if="parseInt(user.status) === 1"
                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                  <span v-else
                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Inactive</span>
                </td>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">
                  <div class="flex" v-if="user.roles[0]">
                    {{ user.roles[0].name.charAt(0).toUpperCase() + user.roles[0].name.slice(1) }}
                  </div>
                </td>
                <td
                  class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                  <Link :href="route('account.edit', { user: user.id })" class="text-indigo-600 hover:text-indigo-900">Edit</Link>
                </td>
              </tr>
              </tbody>
            </table>
          </div>

          <Pager :links="users.links" />
        </div>
      </div>
    </div>
  </AdminLayout>
</template>

<style scoped>

</style>
