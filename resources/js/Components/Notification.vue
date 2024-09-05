<script setup>

import {ref} from "vue";

let job = ref(null);

window.Echo.channel('job')
  .listen('JobPostedEvent', (e) => {
    job.value = e.job;

    setTimeout(() => {
      job.value = null;
    }, 5000)
  });

</script>

<template>
  <div v-if="job" class="fixed bottom-2 right-2 p-4 bg-gray-900">
    The new job has been published: <Link class="text-gray-200 hover:text-blue-400" :href="route('job.index', { 'job': job.id })">{{ job.title  }}</Link>
  </div>
</template>

<style scoped>

</style>
