<script setup>
import Panel from "@/Components/Panel.vue";
import Tag from "@/Components/Models/Tags/Tag.vue";
import EmployerProfileLogo from "@/Components/Models/Employers/EmployerProfileLogo.vue";
import RegularLink from "@/Components/Elements/RegularLink.vue";

defineProps({
  vacancy: {
    type: Object
  }
})
</script>

<template>
  <Panel class="flex flex-col text-center bg-black">
    <div>
      <RegularLink v-if="vacancy.employerProfile" class="self-start text-sm" :href="route('profile.employer.show', { employerProfile: vacancy.employerProfile.id })">{{ vacancy.employerProfile.name }}</RegularLink>
      <div class="text-xs text-gray-300">{{ vacancy.created_at }}</div>
    </div>

    <div class="py-4 space-y-3">
      <h3 class="text-white group-hover:text-blue-600 text-xl text-bold transition-colors duration-300 ">
        <RegularLink :href="route('vacancy.show', { vacancy: vacancy.id })" v-if="vacancy.id">
          {{ vacancy.title }}
        </RegularLink>
        <span v-else>
          {{ vacancy.title }}
        </span>
      </h3>
      <p class="text-sm font-light text-white">{{ vacancy.short_description?.substring(0, 250) + '...' }}</p>
      <p class="text-xs mt-4 text-gray-300">{{ vacancy.schedule }} - {{ vacancy.salary }}</p>
    </div>

    <div class="flex justify-between items-baseline mt-auto gap-2">
      <div class="flex flex-wrap mt-auto gap-2">
        <Tag v-for="tag in vacancy.tags" size="small" :tag/>
      </div>
      <EmployerProfileLogo v-if="vacancy.employerProfile" :employerProfile="vacancy.employerProfile" width="42"/>
    </div>
  </Panel>
</template>
