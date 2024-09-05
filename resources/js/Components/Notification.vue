<script setup>

import {ref} from "vue";

let job = ref(null);

// window.Echo.channel('job')
//   .listen('JobViewedEvent', (e) => {
//     job.value = e.job;
//   });

</script>

<template>
  <div v-if="job" class="fixed bottom-2 right-2 p-4 bg-black/90 pr-12">
    <span>
    The new job has been published: <Link class="text-gray-200 hover:text-blue-400" :href="route('job.index', { 'job': job.id })">{{ job.title  }}</Link>
    </span>
    <button @click="job = null;" class="bg-transparent hover:bg-blue-500 ease-linear hover:rotate-90 p-2 absolute top-0 right-0 rounded-3xl h-8 w-8">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" class="rotate-45"><path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z"></path></svg>
    </button>
  </div>
</template>

<style scoped>

</style>
