<script setup>

const props = defineProps({
  href: String,
  target: String,
})

</script>

<template>
  <a
    :href="props.href"
    :target="props.target"
    class="inline-flex items-center px-4 py-2 bg-blue-700 border border-transparent rounded-3xl font-semibold text-sm text-white tracking-widest hover:bg-blue-500 focus:bg-gray-700 active:bg-gray-900 transition ease-in-out duration-150"
  >
    <slot/>
  </a>
</template>
