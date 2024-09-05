<script setup>
import MainMenu from "@/Components/Menus/MainMenu.vue";
import UserMenu from "@/Components/Menus/UserMenu.vue";
import Footer from "@/Components/Footer.vue";
import {Link} from "@inertiajs/vue3";
import Header from "@/Components/Header.vue";
</script>

<template>
  <div class="px-10 pt-16">
    <Header />
    <main class="mt-12 max-w-7xl mx-auto">
      <slot />
    </main>

    <Footer />
  </div>
</template>
