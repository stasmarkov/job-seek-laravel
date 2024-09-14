<script setup>
import Layout from "@/Layouts/Layout.vue";
import Article from "@/Components/Sections/Article.vue";
import Tag from "@/Components/Models/Tags/Tag.vue";

const props = defineProps({
  candidateProfile: {
    type: Object,
  }
})
</script>

<template>
  <Layout>
    <Head :title="`${candidateProfile.first_name} ${candidateProfile.last_name}`" />

    <Article :hoverable="false">
      <article class="mb-4 pb-4 border-b">
        <div class="flex justify-between items-center">
          <h3 class="text-base font-semibold leading-7">
            <span class="text-3xl font-bold">{{ `${candidateProfile.first_name} ${candidateProfile.last_name}` }}</span>
          </h3>
          <p class="text-xs text-gray-300">{{ candidateProfile.created_at }}</p>
        </div>
        <div class="mt-1">
          <p class="text-sm"><span class="text-gray-300">Experience since:</span> {{ props.candidateProfile.experience_since }}</p>
        </div>
        <p class="mt-4">{{ props.candidateProfile.description }}</p>
      </article>

      <div v-if="candidateProfile.tags.length" class="flex flex-wrap gap-2 mt-4 basis-full md:mt-auto md:flex-1 md:justify-end">
        <Tag v-for="tag in candidateProfile.tags" size="base" :tag/>
      </div>

    </Article>
  </Layout>
</template>
