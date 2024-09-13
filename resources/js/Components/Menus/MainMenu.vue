<script setup>

import NavLink from "@/Components/MenuItems/NavLink.vue";
</script>

<template>
  <nav>
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
  </nav>
</template>
