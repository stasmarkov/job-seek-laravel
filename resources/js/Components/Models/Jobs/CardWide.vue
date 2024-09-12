<script setup>
import Panel from "@/Components/Panel.vue";
import EmployerProfileLogo from "@/Components/Models/Employers/EmployerProfileLogo.vue";
import Tag from "@/Components/Models/Tags/Tag.vue";
import RegularLink from "@/Components/Elements/RegularLink.vue";

const props = defineProps({
  job: Object,
})

</script>

<template>
  <Panel class="flex gap-x-6 flex-wrap bg-black text-white max-w-5xl mx-auto">
    <div v-if="job.employerProfile">
      <EmployerProfileLogo :employerProfile="job.employerProfile"/>
    </div>

    <div class="flex-1 flex flex-col md:flex-1 gap-0.5">
      <RegularLink v-if="job.employerProfile" class="self-start text-sm" :href="route('profile.employer.show', { employerProfile: job.employerProfile.id })">{{ job.employerProfile.name }}</RegularLink>
      <h3 class="text-white font-bold text-xl mt-2 group-hover:text-blue-600 transition-colors duration-300">
        <Link :href="route('job.show', { job: job.id })" v-if="job.id">
          {{ job.title }}
        </Link>
        <span v-else>
          {{ job.title }}
        </span>
      </h3>
      <p class="text-md font-light">{{ job.short_description?.substring(0, 100) + '...' }}</p>
      <p class="text-sm text-gray-500 mt-auto">{{ job.schedule }} - {{ job.salary }}</p>
    </div>

    <div v-if="job.tags.length" class="flex flex-wrap gap-2 mt-4 basis-full md:mt-auto md:flex-1 md:justify-end">
      <Tag v-for="tag in job.tags" size="base" :tag/>
    </div>
  </Panel>
</template>
