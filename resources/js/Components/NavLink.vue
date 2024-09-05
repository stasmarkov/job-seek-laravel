<script setup>

const props = defineProps({
  href: {
    type: String,
    required: true,
  },
  active: {
    type: Boolean,
  },
});

</script>

<template>
  <Link :href="href"
    class="inline-flex items-center px-4 py-2 border-b-2 text-md font-medium leading-5 text-white focus:outline-none focus:border-indigo-500 transition duration-150 ease-in-out"
    :class="{
      'border-blue-700 focus:outline-none focus:border-blue-700' : props.active,
      'border-transparent hover:text-gray-700 hover:border-blue-500 focus:outline-none focus:text-gray-700 focus:border-gray-300': !props.active
  }">
    <slot/>
  </Link>
</template>
