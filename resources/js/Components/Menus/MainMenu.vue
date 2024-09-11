<script setup>

import NavLink from "@/Components/MenuItems/NavLink.vue";
</script>

<template>
  <nav>
    <NavLink
      :href="route('search.jobs')"
      :active="route().current('search.jobs')"
      class="hover:text-white/70"
    >Jobs</NavLink>
    <NavLink
      :href="route('contact.index')"
      :active="route().current('contact.index')"
      class="hover:text-white/70"
    >Contact Us</NavLink>
  </nav>
</template>
