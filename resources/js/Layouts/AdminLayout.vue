<script setup>

import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import {Link} from "@inertiajs/vue3";
import AdminSidebarMenuDesktop from "@/Components/Menus/AdminSidebarMenuDesktop.vue";
import AdminSidebarMenuMobile from "@/Components/Menus/AdminSidebarMenuMobile.vue";
import {ref} from "vue";

const isOpened = ref(false);
</script>

<template>
  <Head>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
  </Head>
  <div class="h-screen flex overflow-hidden bg-gray-100">
    <!-- Off-canvas menu for mobile -->
    <div class="md:hidden">
      <div class="fixed inset-0 z-40" :class="{
        'hidden': !isOpened,
        'flex': isOpened,
      }">
        <div class="fixed inset-0">
          <div class="absolute inset-0 bg-gray-600 opacity-75"></div>
        </div>
        <div class="relative flex-1 flex flex-col max-w-xs w-full bg-gray-800">
          <div class="absolute top-0 right-0 -mr-14 p-1">
            <button
              class="flex items-center justify-center h-12 w-12 rounded-full focus:outline-none focus:bg-gray-600"
              aria-label="Close sidebar" @click="isOpened = !isOpened">
              <svg class="h-6 w-6 text-white" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M6 18L18 6M6 6l12 12"/>
              </svg>
            </button>
          </div>
          <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
            <div class="flex-shrink-0 flex items-center px-4">
              <Link :href="route('homepage')">
                <ApplicationLogo/>
              </Link>
            </div>
            <AdminSidebarMenuMobile />
          </div>
          <div class="flex-shrink-0 flex bg-gray-700 p-4">
            <Link :href="route('account.edit', { user: $page.props.auth.user.id })" class="flex-shrink-0 group block">
              <div class="flex items-center">
                <div>
                  <img class="inline-block h-10 w-10 rounded-full"
                       :src="$page.props.auth.user.avatar"
                       alt="">
                </div>
                <div class="ml-3">
                  <p class="text-base leading-6 font-medium text-white">
                    {{ $page.props.auth.user.name }}
                  </p>
                  <p
                    class="text-sm leading-5 font-medium text-gray-400 group-hover:text-gray-300 transition ease-in-out duration-150">
                    View profile
                  </p>
                </div>
              </div>
            </Link>
          </div>
        </div>
        <div class="flex-shrink-0 w-14">
          <!-- Force sidebar to shrink to fit close icon -->
        </div>
      </div>
    </div>

    <!-- Static sidebar for desktop -->
    <div class="hidden md:flex md:flex-shrink-0">
      <div class="flex flex-col w-64 bg-gray-800">
        <div class="h-0 flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
          <div class="flex items-center flex-shrink-0 px-4">
            <Link :href="route('homepage')">
              <ApplicationLogo/>
            </Link>
          </div>
          <AdminSidebarMenuDesktop />
        </div>
        <div class="flex-shrink-0 flex bg-gray-700 p-4">
          <Link :href="route('account.edit', { user: $page.props.auth.user.id })" class="flex-shrink-0 group block">
            <div class="flex items-center">
              <div>
                <img class="inline-block h-10 w-10 rounded-full"
                     :src="$page.props.auth.user.avatar"
                     alt="">
              </div>
              <div class="ml-3">
                <p class="text-base leading-6 font-medium text-white">
                  {{ $page.props.auth.user.name }}
                </p>
                <p
                  class="text-sm leading-5 font-medium text-gray-400 group-hover:text-gray-300 transition ease-in-out duration-150">
                  View profile
                </p>
              </div>
            </div>
          </Link>
        </div>
      </div>
    </div>
    <div class="flex flex-col w-0 flex-1 overflow-hidden">
      <div class="md:hidden pl-1 sm:pt-1 sm:pl-3 flex justify-end border-b">
        <button
          @click="isOpened = !isOpened"
          class="-ml-0.5 -mt-0.5 h-12 w-12 inline-flex items-center justify-center rounded-md text-gray-500 hover:text-gray-900 focus:outline-none focus:bg-gray-200 transition ease-in-out duration-150"
          aria-label="Open sidebar">
          <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
          </svg>
        </button>
      </div>
      <main class="flex-1 relative z-0 overflow-y-auto focus:outline-none" tabindex="0">
        <div class="pt-2 pb-6 md:py-6">
          <div class="mx-auto px-4 sm:px-6 lg:px-8 mb-4">
            <h1 class="text-2xl font-semibold text-gray-900">
              <slot name="heading"/>
            </h1>
          </div>
          <div class="mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden p-4 sm:p-8">
              <slot />
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>

</template>

<style scoped>

</style>
