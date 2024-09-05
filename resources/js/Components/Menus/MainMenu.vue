<script setup>

import {Link} from "@inertiajs/vue3";
import NavLink from "@/Components/NavLink.vue";
</script>

<template>
  <nav>
    <NavLink
      :href="route('search', {'q': '_all'})"
      :active="route().current('search')"
      class="hover:text-white/70"
    >
      Jobs
    </NavLink>
    <NavLink
      :href="route('homepage')"
      :active="route().current('homepage')"
      class="hover:text-white/70"
    >
      Blog
    </NavLink>
  </nav>
</template>
