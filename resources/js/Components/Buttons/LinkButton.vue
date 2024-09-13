<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
  href: String,
  target: String,
})

</script>

<template>
  <Link
    :href="props.href"
    :target="props.target"
    class="inline-flex items-center px-4 py-2 bg-blue-700 border border-transparent rounded-3xl font-semibold text-sm text-white tracking-widest hover:bg-pink-500 focus:bg-pink-700 active:bg-pink-900 transition ease-linear duration-300"
  >
    <slot/>
  </Link>
</template>

<style scoped>

</style>
