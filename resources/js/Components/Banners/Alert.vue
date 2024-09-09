<script setup>

import BgBlur from "@/Components/BgBlur.vue";
</script>

<template>
  <div
    class="flex items-center gap-x-6 bg-gray-50 px-6 py-2.5 sm:px-3.5 sm:before:flex-1">
    <div class="flex flex-wrap items-center gap-x-4 gap-y-2">
      <p class="text-sm leading-6 text-gray-900">
        <strong class="font-semibold">Stanislav Markov {{ new Date().getFullYear() }}</strong>
        <svg viewBox="0 0 2 2" class="mx-2 inline h-0.5 w-0.5 fill-current" aria-hidden="true">
          <circle cx="1" cy="1" r="1"/>
        </svg>
        This site is not for real usage, be aware of <span class="font-bold text-red-950">NOT</span> sharing any sensitive and private information here.
      </p>
    </div>
    <div class="flex flex-1 justify-end">
    </div>
  </div>
</template>

<style scoped>

</style>
