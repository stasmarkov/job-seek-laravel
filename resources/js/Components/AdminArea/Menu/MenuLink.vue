<script setup>
const props = defineProps({
  href: String,
  target: String,
})
</script>

<template>
  <Link :href="props.href"
     class="text-white group flex items-center px-2 py-2 text-sm leading-5 font-medium rounded-md focus:outline-none transition ease-in-out duration-150"
  >
    <slot/>
  </Link>

</template>

<style scoped>

</style>
