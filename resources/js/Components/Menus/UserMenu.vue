<script setup>

import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import {useCurrentUser} from "@/Composables/useCurrentUser.js";

defineProps({
  can: Object,
})
</script>

<template>
  <nav>
    <Dropdown align="right" width="48">
      <template #trigger>
        <span class="inline-flex rounded-md">
          <button
            type="button"
            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-3xl text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
          >
            <span v-if="useCurrentUser().isLoggedIn()">
              {{ useCurrentUser().name }}
            </span>
            <span v-else>
              My Account
            </span>

            <svg
              class="ms-2 -me-0.5 h-4 w-4"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 20 20"
              fill="currentColor"
            >
              <path
                fill-rule="evenodd"
                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                clip-rule="evenodd"
              />
            </svg>
          </button>
        </span>
      </template>

      <template #content>
        <DropdownLink :href="route('dashboard')" v-if="useCurrentUser().isLoggedIn()">Dashboard</DropdownLink>
        <DropdownLink :href="route('logout')" method="post" as="button" v-if="useCurrentUser().isLoggedIn()">
          Log Out
        </DropdownLink>

        <DropdownLink :href="route('login')" v-if="!useCurrentUser().isLoggedIn()">Log In</DropdownLink>
        <DropdownLink :href="route('register')" v-show="!useCurrentUser().isLoggedIn()">Sign Up</DropdownLink>
      </template>
    </Dropdown>
  </nav>
</template>

<style scoped>


</style>
