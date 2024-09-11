<script setup>

import {Link} from "@inertiajs/vue3";
import MainMenu from "@/Components/Menus/MainMenu.vue";
import UserMenu from "@/Components/Menus/UserMenu.vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
</script>

<template>
  <header>
    <div class="fixed z-[100] left-0 top-0 z-10 bg-black border-b border-white/10 w-full">
      <div class="flex justify-between items-center py-4  w-full max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div>
          <Link :href="route('homepage')">
            <ApplicationLogo />
          </Link>
        </div>
        <div class="space-x-6 font-bold">
          <MainMenu />
        </div>

        <div class="space-x-6 font-bold flex">
          <UserMenu />
        </div>
      </div>
    </div>
  </header>
</template>

<style scoped>

</style>
