<script setup>
defineProps({
  employerProfile: Object,
})
</script>

<template>
  <img :src="employerProfile.logo" alt="Logo" class="rounded-xl" width="90">
</template>
