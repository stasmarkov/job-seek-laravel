<script setup>

const props = defineProps({
  value: String,
  label: String,
  canSort: Boolean,
  sortField: String,
  sortAsc: String,
})

</script>

<template>
  <th
    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
    <a class="flex items-center" href="#">{{ props.label }}</a>
  </th>
</template>
