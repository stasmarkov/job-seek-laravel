<script setup>

import {Link} from "@inertiajs/vue3";
</script>

<template>
  <Link
    :href="route('search', {'q': '_all'})"
    class="hover:text-white/70"
  >
    Jobs
  </Link>
  <Link
    :href="route('homepage')"
    class="hover:text-white/70"
  >
    Blog
  </Link>
</template>
