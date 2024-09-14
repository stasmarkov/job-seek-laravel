<script setup>
import Panel from "@/Components/Panel.vue";
import EmployerProfileLogo from "@/Components/Models/Employers/EmployerProfileLogo.vue";
import Tag from "@/Components/Models/Tags/Tag.vue";
import RegularLink from "@/Components/Elements/RegularLink.vue";

const props = defineProps({
  vacancy: Object,
})

</script>

<template>
  <Panel class="flex gap-x-6 flex-wrap bg-black text-white max-w-5xl mx-auto">
    <div v-if="vacancy.employerProfile">
      <EmployerProfileLogo :employerProfile="vacancy.employerProfile"/>
    </div>

    <div class="flex-1 flex flex-col md:flex-1 gap-0.5">
      <span class="text-sm">Employer: <RegularLink v-if="vacancy.employerProfile" class="self-start" :href="route('profile.employer.show', { employerProfile: vacancy.employerProfile.id })">{{ vacancy.employerProfile.name }}</RegularLink></span>
      <span class="text-xs text-gray-300">{{ vacancy.created_at }}</span>
      <h3 class="text-white font-bold text-xl mt-2 group-hover:text-blue-600 transition-colors duration-300">
        <RegularLink :href="route('vacancy.show', { vacancy: vacancy.id })" v-if="vacancy.id">
          {{ vacancy.title }}
        </RegularLink>
        <span v-else>
          {{ vacancy.title }}
        </span>
      </h3>
      <p class="text-md font-light">{{ vacancy.short_description?.substring(0, 100) + '...' }}</p>
      <p class="text-sm text-gray-500 mt-auto">{{ vacancy.schedule }} - {{ vacancy.salary }}</p>
    </div>

    <div v-if="vacancy.tags.length" class="flex flex-wrap gap-2 mt-4 basis-full md:mt-auto md:flex-1 md:justify-end">
      <Tag v-for="tag in vacancy.tags" size="base" :tag/>
    </div>
  </Panel>
</template>
