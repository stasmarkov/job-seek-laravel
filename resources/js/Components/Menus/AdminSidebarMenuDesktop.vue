<script setup>

import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";
import {faRightFromBracket, faSuitcase} from "@fortawesome/free-solid-svg-icons";
import {Link} from "@inertiajs/vue3";
import AdminDashboardNavLink from "@/Components/MenuItems/AdminDashboardNavLink.vue";
</script>

<template>
  <!--   Sidebar component, swap this element with another sidebar if you like -->
  <nav class="mt-5 flex-1 px-2 bg-gray-800">
    <AdminDashboardNavLink :href="route('dashboard')" :active="route().current('dashboard')">
      <svg
        class="mr-2 h-4 w-4  group-hover:text-gray-300 group-focus:text-gray-300 transition ease-in-out duration-150"
        fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
      </svg>
      Dashboard
    </AdminDashboardNavLink>
    <AdminDashboardNavLink :href="route('vacancy.index')" v-if="$page.props.isAdmin || $page.props.isEmployer">
      <svg
        class="mr-2 h-4 w-4 group-hover:text-gray-300 group-focus:text-gray-300 transition ease-in-out duration-150"
        fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
      </svg>
      My vacancies
    </AdminDashboardNavLink>
    <AdminDashboardNavLink :href="route('vacancy.create')" v-if="$page.props.isAdmin || $page.props.isEmployer">
      <font-awesome-icon :icon="faSuitcase" class="mr-2 h-4 w-4 group-hover:text-gray-300 group-focus:text-gray-300 transition ease-in-out duration-150" />
      Post a new vacancy
    </AdminDashboardNavLink>
    <AdminDashboardNavLink
      :href="route('logout')"
      method="post"
    >
      <font-awesome-icon :icon="faRightFromBracket" class="mr-2 h-4 w-4 group-hover:text-gray-300 group-focus:text-gray-300 transition ease-in-out duration-150" />
      Log Out
    </AdminDashboardNavLink>


  </nav>
</template>

<style scoped>

</style>
