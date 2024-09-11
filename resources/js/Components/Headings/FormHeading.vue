<script setup>
defineProps({
  description: String,
})
</script>

<template>
  <header>
    <h2 class="text-lg font-medium text-gray-900">
      <slot />
    </h2>
    <p class="mt-1 text-sm text-gray-600" v-if="description">
      {{ description }}
    </p>
  </header>
</template>
