<script setup>

const props = defineProps({
  hoverable: {
    type: Boolean,
    default: true,
  },
})
</script>

<template>
  <div
    class="p-4 rounded-xl border border-transparent group transition-colors duration-300 bg-gray-900"
    :class="{
      'hover:border-blue-600' : props.hoverable,
    }"
  >
    <slot/>
  </div>
</template>
