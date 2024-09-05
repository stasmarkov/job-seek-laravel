<script setup>
defineProps({
  employer: Object,
})
</script>

<template>
  <img :src="employer.logo" alt="Logo" class="rounded-xl" width="90">
</template>
