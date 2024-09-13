<script setup>

import {Link} from "@inertiajs/vue3";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import AdminSidebarMenuMobile from "@/Components/Menus/AdminSidebarMenuMobile.vue";
import {ref} from "vue";
import NavLink from "@/Components/MenuItems/NavLink.vue";
import {useCurrentUser} from "@/Composables/useCurrentUser.js";
import DropdownLink from "@/Components/Dropdowns/DropdownLink.vue";

const isOpened = ref(false);
</script>

<template>
  <div class="md:hidden pl-1 sm:pt-1 sm:pl-3 flex flex-1 justify-end">
    <button
      @click="isOpened = !isOpened"
      class="-ml-0.5 -mt-0.5 h-12 w-12 inline-flex items-center justify-center rounded-md text-gray-500 hover:text-gray-900 focus:outline-none focus:bg-gray-200 transition ease-in-out duration-150"
      aria-label="Open sidebar">
      <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
      </svg>
    </button>
  </div>
  <!-- Off-canvas menu for mobile -->
  <div class="md:hidden">
    <div class="fixed inset-0 z-40" :class="{
        'hidden': !isOpened,
        'flex': isOpened,
      }">

      <div class="relative flex-1 flex flex-col w-full bg-gray-800">
        <div class="absolute top-3 right-1 sm:right-5 p-1">
          <button
            class="flex items-center justify-center h-12 w-12 rounded-full focus:outline-none focus:bg-gray-600"
            aria-label="Close sidebar" @click="isOpened = !isOpened">
            <svg class="h-6 w-6 text-white" stroke="currentColor" fill="none" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M6 18L18 6M6 6l12 12"/>
            </svg>
          </button>
        </div>
        <div class="flex-1 h-0 pt-4 pb-4 overflow-y-auto">
          <div class="flex-shrink-0 px-2">
            <div>
              <Link :href="route('homepage')">
                <ApplicationLogo/>
              </Link>
            </div>
            <div class="mt-4 flex flex-col">
              <NavLink
                :href="route('search.vacancies')"
                :active="route().current('search.vacancies')"
                class="hover:text-white/70"
              >Vacancies</NavLink>
              <NavLink
                :href="route('search.candidates')"
                :active="route().current('search.candidates')"
                class="hover:text-white/70"
              >Candidates</NavLink>
              <NavLink
                :href="route('contact.index')"
                :active="route().current('contact.index')"
                class="hover:text-white/70"
              >Contact Us</NavLink>
            </div>
            <div class="mt-4 flex flex-col">
              <NavLink
                :href="route('dashboard')"
                v-if="useCurrentUser().isLoggedIn()"
                class="hover:text-white/70"
              >Dashboard</NavLink>
              <NavLink
                :href="route('logout')"
                method="post"
                as="button"
                v-if="useCurrentUser().isLoggedIn()"
                class="hover:text-white/70"
              >Log Out
              </NavLink>

              <NavLink
                :href="route('login')"
                v-if="!useCurrentUser().isLoggedIn()"
                class="hover:text-white/70"
              >Log In</NavLink>
              <NavLink
                :href="route('register')"
                v-show="!useCurrentUser().isLoggedIn()"
                class="hover:text-white/70"
              >Sign Up</NavLink>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>
