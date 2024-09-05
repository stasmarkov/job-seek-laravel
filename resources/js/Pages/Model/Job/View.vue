<script setup>
  import Layout from "@/Layouts/Layout.vue";
  import Panel from "@/Components/Panel.vue";
  import LinkButton from "@/Components/Buttons/LinkButton.vue";
  import EmployerLogo from "@/Components/Employers/EmployerLogo.vue";
  import Tag from "@/Components/Tags/Tag.vue";

  defineProps({
    job: Object,
  })
</script>

<template>
  <Layout>
    <Panel>
      <div class="border-b pb-4 flex justify-between items-center gap-2">
        <h1 class="text-3xl font-bold">{{ job.title }}</h1>
        <EmployerLogo :employer="job.employer" width="50"/>
      </div>
      <div class="info mt-4 border-b pb-4 text-gray-100 font-light">
        <h2 class="text-xl font-medium">General information:</h2>
        <p class="mt-2">{{ job.description }}</p>
        <div class="mt-4 space-y-2">
          <p><strong>Salary:</strong> <i>{{ job.salary }}</i></p>
          <p><strong>Schedule:</strong> <i>{{ job.schedule }}</i></p>
          <p><strong>Location:</strong> <i>{{ job.location }}</i></p>
        </div>
      </div>
      <div class="employer mt-4 border-b pb-4">
        <div class="mt-4 space-y-2">
          <p><strong>Company name:</strong> <i>{{ job.employer.name }}</i></p>
        </div>
      </div>
      <div class="tags mt-4 border-b pb-4">
        <div class="flex flex-wrap mt-auto gap-2">
          <Tag v-for="tag in job.tags" size="small" :tag/>
        </div>
      </div>
      <div class="mt-4 flex justify-end">
        <a :href="job.url" target="_blank" class="inline-flex items-center px-4 py-2 bg-blue-700 border border-transparent rounded-md font-semibold text-sm text-white tracking-widest hover:bg-blue-500 focus:bg-gray-700 active:bg-gray-900 transition ease-in-out duration-150">View more</a>
      </div>
    </Panel>
  </Layout>
</template>

<style scoped>

</style>
