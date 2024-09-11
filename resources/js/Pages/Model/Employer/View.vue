<script setup>
import Layout from "@/Layouts/Layout.vue";
import Panel from "@/Components/Panel.vue";
import EmployerProfileLogo from "@/Components/Models/Employers/EmployerProfileLogo.vue";
import LinkButton from "@/Components/Buttons/LinkButton.vue";
import Heading from "@/Components/Heading.vue";
import CardWide from "@/Components/Models/Jobs/CardWide.vue";

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
    <Head :title="employerProfile.data.name" />

    <Panel :hoverable="false">
      <article class="flex justify-between mb-4 pb-4 border-b">
        <h1 class="text-2xl">{{ employerProfile.data.name }}</h1>
        <EmployerProfileLogo :employerProfile="employerProfile.data" width="45" />
      </article>

      <section class="mt-6 space-y-6">
        <CardWide v-for="job in props.jobs.data" :job />
      </section>
    </Panel>
  </Layout>
</template>
