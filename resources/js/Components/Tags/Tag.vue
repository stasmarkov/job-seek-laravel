<script setup>
  defineProps({
    tag: String,
    size: String
  })
</script>

<template>
  <a :href="route('homepage')"
     class="bg-white/10 px-3 py-1 rounded-2xl font-bold hover:bg-white/25 transition-colors duration-300"
     :class="{
      'px-5 py-1 text-sm' : size === 'base',
      'px-3 py-1 text-xs' : size === 'small',
  }">{{ tag.name }}</a>

</template>
