<script setup>
import Layout from "@/Layouts/Layout.vue";
import Panel from "@/Components/Panel.vue";
import EmployerProfileLogo from "@/Components/Models/Employers/EmployerProfileLogo.vue";
import LinkButton from "@/Components/Buttons/LinkButton.vue";
import BlockHeading from "@/Components/Headings/BlockHeading.vue";
import CardWide from "@/Components/Models/Jobs/CardWide.vue";
import Article from "@/Components/Sections/Article.vue";

const props = defineProps({
  employerProfile: {
    type: Object,
  },
  jobs: {
    type: Object,
  }
})
</script>

<template>
  <Layout>
    <Head :title="employerProfile.name" />

    <Article :hoverable="false">
      <article class="flex justify-between mb-4 pb-4 border-b">
        <h1 class="text-2xl">{{ employerProfile.name }}</h1>
        <EmployerProfileLogo :employerProfile="employerProfile" width="45" />
      </article>

      <section class="mt-6 space-y-6">
        <CardWide v-for="job in props.jobs" :job />
      </section>
    </Article>
  </Layout>
</template>
