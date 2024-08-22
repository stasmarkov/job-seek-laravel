<script setup>
import Panel from "@/Components/Panel.vue";
import Tag from "@/Components/Tags/Tag.vue";
import EmployerLogo from "@/Components/Employers/EmployerLogo.vue";

defineProps({
  job: {
    type: Object
  }
})
</script>

<template>


  <Panel class="flex flex-col text-center">
    <div class="self-start text-sm">{{ job.employer.name }}</div>

    <div class="py-8">
      <h3 class="group-hover:text-blue-600 text-xl text-bold transition-colors duration-300">
        <a href="{{ job.url }}" target="_blank">
          {{ job.title }}
        </a>
      </h3>
      <p class="text-sm mt-4">{{ job.schedule }} - {{ job.salary }}</p>
    </div>

    <div class="flex justify-between items-baseline mt-auto gap-2">
      <div class="flex flex-wrap mt-auto gap-2">
        <Tag v-for="tag in job.tags" size="small" :tag/>
      </div>
      <EmployerLogo :employer="job.employer" width="42"/>
    </div>
  </Panel>
</template>
