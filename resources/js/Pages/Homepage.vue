<script setup>

import Layout from "@/Layouts/Layout.vue";
import Heading from "@/Components/Heading.vue";
import JobCard from "@/Components/Jobs/JobCard.vue";
import Tag from "@/Components/Tags/Tag.vue";
import JobCardWide from "@/Components/Jobs/JobCardWide.vue";
import LinkButton from "@/Components/Buttons/LinkButton.vue";
import SearchJobForm from "@/Components/Forms/SearchJobForm.vue";
import {Head, useForm} from '@inertiajs/vue3';
import { Inertia } from "@inertiajs/inertia";

// Properties given by the route should be defined using defineProps.
defineProps({
  featuredJobs: {
    type: Object
  },
  jobs: {
    type: Object
  },
  tags: {
    type: Object,
  }
});

function redirectOnSearchPage(value) {
  Inertia.get(route('search.jobs'), {'search': value});
}

</script>

<template>
  <Head title="Homepage" />
  <Layout>
    <div class="space-y-4">
      <section>
        <section class="text-center pt-6">
          <SearchJobForm @searchFormSubmitEvent="redirectOnSearchPage"/>
        </section>

        <Heading>Featured Jobs</Heading>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8 mt-6">
          <JobCard v-for="job in featuredJobs.data" :job />
        </div>
      </section>

      <section>
        <Heading>Tags</Heading>
        <div class="mt-6 gap-2 flex flex-wrap">
          <Tag v-for="tag in tags.data" :tag :size="base" />
        </div>
      </section>

      <section class="mt-6 space-y-6">
        <Heading>Recent Jobs</Heading>
        <JobCardWide v-for="job in jobs.data" :job />

        <div class="flex justify-center mt-2">
          <LinkButton :href="route('search.jobs')">{{ ('View more') }}</LinkButton>
        </div>
      </section>
    </div>
  </Layout>
</template>
