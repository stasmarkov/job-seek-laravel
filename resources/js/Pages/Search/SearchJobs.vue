<script setup>
import Layout from "@/Layouts/Layout.vue";
import Heading from "@/Components/Heading.vue";
import JobCardWide from "@/Components/Jobs/JobCardWide.vue";
import SearchJobForm from "@/Components/Forms/SearchJobForm.vue";
import Pager from "@/Components/Pager.vue";
import {ref, watch} from "vue";
import {Inertia} from "@inertiajs/inertia"

// Properties given from controller and parent components.
const props = defineProps({
  results: Object,
  filters: Object
});

// The search string.
let searchString = ref(props.filters.search ?? '');

// The callback on search.
function searchFormSubmit(searchSubmitValue) {
  searchString.value = searchSubmitValue;
}

// Watch changes and perform request.
watch(searchString, value => {
  Inertia.get('/search', { search: value }, {
    preserveState: true,
    preserveScroll: true,
  });
});

</script>

<template>
  <Head title="Search"/>

  <Layout>
    <section class="text-center pt-6">
      <h1 class="font-bold text-4xl">Let's Find Your NExt Job</h1>
      <SearchJobForm :searchString @searchFormSubmitEvent="searchFormSubmit"/>
    </section>

    <heading>{{ ('Search results') }}</heading>

    <div class="mt-4">
      <div v-if="props.results.data.length > 0">
        <div class="space-y-4">
          <JobCardWide v-for="job in props.results.data" :job :key="job.id"/>
        </div>

        <div class="flex justify-center px-2 mt-6">
          <Pager :links="props.results.links"></Pager>
        </div>
      </div>
      <div class="text-xl text-center" v-else>
        {{ ('Oops! No results found :\'(') }}
      </div>
    </div>
  </Layout>
</template>
