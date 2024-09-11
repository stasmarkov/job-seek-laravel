<script setup>
import {computed} from "vue";

const props = defineProps({
  href: {
    type: String,
    required: true,
  },
  target: {
    type: String,
  },
});

const isActive = computed(() => {
  return props.href === route(route().current(), route().params);
})

</script>

<template>
  <Link :href="props.href"
     class="group flex items-center px-2 py-2 text-sm leading-5 font-medium rounded-md focus:outline-none transition ease-in-out duration-150"
      :class="{
        'text-blue-200 underline': isActive,
        'text-white': !isActive
      }"
  >
    <slot/>
  </Link>
</template>
