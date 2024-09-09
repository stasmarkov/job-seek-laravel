<script setup>
  import Layout from "@/Layouts/Layout.vue";
  import Panel from "@/Components/Panel.vue";
  import LinkButton from "@/Components/Buttons/LinkButton.vue";
  import EmployerLogo from "@/Components/Employers/EmployerLogo.vue";
  import Tag from "@/Components/Tags/Tag.vue";
  import AnchorButton from "@/Components/Buttons/AnchorButton.vue";
  import LikeDislike from "@/Components/Reactions/Like.vue";
  import {Inertia} from "@inertiajs/inertia";

  const props = defineProps({
    job: Object,
    can: Object,
    likesCount: Number,
    isLiked: Boolean,
  });

  const like = () => {
    Inertia.get(route('job.like', {'job': props.job.data.id }));
  }
</script>

<template>
  <Head :title="props.job.data.title" >
    <meta name="description" :content="props.job.data.short_description">
  </Head>

  <Layout>
    <div v-if="can.edit_job" class="flex gap-2 mb-2">
      <LinkButton  class="bg-green-600" :href="route('job.edit', { job: props.job.data.id })">Edit</LinkButton>
    </div>

    <Panel>
      <div class="border-b pb-4 flex justify-between items-center gap-2">
        <h1 class="text-3xl font-bold">{{ props.job.data.title }}</h1>
        <EmployerLogo :employer="props.job.data.employer" width="50"/>
      </div>
      <div class="info mt-4 border-b pb-4 text-gray-100 font-light">
        <h2 class="text-xl font-medium">General information:</h2>
        <div class="mt-2" v-html="props.job.data.description"></div>
        <div class="mt-4 space-y-2">
          <p><strong>Salary:</strong> <i>{{ props.job.data.salary }}</i></p>
          <p><strong>Schedule:</strong> <i>{{ props.job.data.schedule }}</i></p>
          <p><strong>Location:</strong> <i>{{ props.job.data.location }}</i></p>
        </div>
      </div>
      <div class="employer mt-4 border-b pb-4">
        <div class="mt-4 space-y-2">
          <p><strong>Company name:</strong> <i>{{ props.job.data.employer.name }}</i></p>
        </div>
      </div>
      <div class="tags mt-4 border-b pb-4">
        <div class="flex flex-wrap mt-auto gap-2">
          <Tag v-for="tag in props.job.data.tags" size="small" :tag/>
        </div>
      </div>
      <div class="mt-4 flex justify-end">
        <LikeDislike :route="route('job.like', {'job': props.job.data.id })" :likesCount="props.likesCount" :isLiked="props.isLiked" />
        <AnchorButton :href="props.job.data.url" target="_blank">View more</AnchorButton>
      </div>
    </Panel>
  </Layout>
</template>

<style scoped>

</style>
