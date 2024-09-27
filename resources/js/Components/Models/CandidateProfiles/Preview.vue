<script setup>

import Tag from "@/Components/Models/Tags/Tag.vue";
import RegularLink from "@/Components/Elements/RegularLink.vue";
import Article from "@/Components/Sections/Article.vue";
import Panel from "@/Components/Panel.vue";

defineProps({
  candidateProfile: {
    type: Object,
    required: true,
  }
})
</script>

<template>
  <Panel>
    <RegularLink :href="route('profile.candidate.show', { candidate_profile: candidateProfile.id})">
      <h3 class="text-lg">{{ `${candidateProfile.first_name} ${candidateProfile.last_name}` }}</h3>
    </RegularLink>
    <p class="text-sm"><span class="text-gray-300">Experience since:</span> {{ candidateProfile.experience_since }}</p>
    <p class="text-sm mt-2">{{ candidateProfile.description.slice(0, 250) + '...' }}</p>

    <div class="flex flex-wrap gap-2 mt-2">
      <Tag v-for="tag in candidateProfile.tags" size="small" :tag/>
    </div>
  </Panel>
</template>
