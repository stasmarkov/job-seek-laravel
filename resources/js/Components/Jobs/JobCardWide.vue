<script setup>

import Panel from "@/Components/Panel.vue";
import EmployerLogo from "@/Components/Employers/EmployerLogo.vue";
import Tag from "@/Components/Tags/Tag.vue";

defineProps({
  job: Object,
})

</script>

<template>
  <Panel class="flex gap-x-6 flex-wrap">
    <div>
      <EmployerLogo :employer="job.employer"/>
    </div>

    <div class="flex-1 flex flex-col md:flex-1">
      <a href="#" class="self-start text-sm text-gray-400 ">{{ job.employer.name }}</a>
      <h3 class="font-bold text-xl mt-2 group-hover:text-blue-600 transition-colors duration-300">
        <a :href="job.url" target="_blank">
          {{ job.title }}
        </a>
      </h3>
      <p class="text-sm text-gray-500 mt-auto">{{ job.schedule }} - {{ job.salary }}</p>
    </div>

    <div v-if="job.tags.length" class="flex flex-wrap gap-2 mt-4 basis-full md:mt-auto md:flex-1 md:justify-end">
      <Tag v-for="tag in job.tags" size="base" :tag/>
    </div>
  </Panel>
</template>
