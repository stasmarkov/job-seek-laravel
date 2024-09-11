<script setup>
  const props = defineProps({
    links: Array
  })

</script>

<template>
  <div class="gap-2 flex flex-wrap justify-center">
    <Component
      :is="link.url && !link.active ? 'Link' : 'span'"
      v-for="link in props.links"
      v-html="link.label"
      :href="link.url"
      class="text-blue-400 p-2 bg-gray-900 hover:bg-gray-700"
      :class="{
       'text-gray-400 hover:bg-gray-900': !link.url || link.active,
      }"
    />
  </div>
</template>
