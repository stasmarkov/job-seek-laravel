<script setup>
import Panel from "@/Components/Panel.vue";
import Tag from "@/Components/Models/Tags/Tag.vue";
import EmployerProfileLogo from "@/Components/Models/Employers/EmployerProfileLogo.vue";
import RegularLink from "@/Components/Elements/RegularLink.vue";

defineProps({
  job: {
    type: Object
  }
})
</script>

<template>
  <Panel class="flex flex-col text-center bg-black">
    <RegularLink v-if="job.employerProfile" class="self-start text-sm" :href="route('profile.employer.show', { employerProfile: job.employerProfile.id })">{{ job.employerProfile.name }}</RegularLink>

    <div class="py-8 space-y-3">
      <h3 class="text-white group-hover:text-blue-600 text-xl text-bold transition-colors duration-300 ">
        <Link :href="route('job.show', { job: job.id })" v-if="job.id">
          {{ job.title }}
        </Link>
        <span v-else>
          {{ job.title }}
        </span>
      </h3>
      <p class="text-sm font-light text-white">{{ job.short_description?.substring(0, 250) + '...' }}</p>
      <p class="text-xs mt-4 text-gray-300">{{ job.schedule }} - {{ job.salary }}</p>
    </div>

    <div class="flex justify-between items-baseline mt-auto gap-2">
      <div class="flex flex-wrap mt-auto gap-2">
        <Tag v-for="tag in job.tags" size="small" :tag/>
      </div>
      <EmployerProfileLogo v-if="job.employerProfile" :employerProfile="job.employerProfile" width="42"/>
    </div>
  </Panel>
</template>
