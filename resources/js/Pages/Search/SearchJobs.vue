<script setup>
import Layout from "@/Layouts/Layout.vue";
import Heading from "@/Components/Heading.vue";
import JobCardWide from "@/Components/Jobs/JobCardWide.vue";
import SearchJobForm from "@/Components/Forms/SearchJobForm.vue";
import Pager from "@/Components/Pager.vue";
import {ref, watch} from "vue";
import {router} from "@inertiajs/vue3";
import {throttle, debounce} from "lodash";
import CheckboxButtons from "@/Components/Forms/CheckboxButtons.vue";

// Properties given from controller and parent components.
const props = defineProps({
  results: Object,
  filters: Object,
  tags: Object,
});

// The search string.
let searchString = ref(props.filters.search ?? '');
let order = ref(props.filters.order ?? 'DESC');
let tags = ref(props.filters.tags ?? []);

// The callback on tags checkboxes.
function searchFormSubmit(searchSubmitValue) {
  searchString.value = searchSubmitValue;
}

// The callback on search.
function checkboxFormSubmit(value) {
  tags.value = value;
}

// throttle - Makes request with some period.
// debounce - Makes request after some period.
watch([order, searchString, tags], throttle(function ([orderValue, searchValue, tagsValue]) {
  router.get(route('search.jobs'), {order: orderValue, search: searchValue, tags: tagsValue}, {
    preserveState: true,
    preserveScroll: true,
    replace: true
  })
}, 500))

</script>

<template>
  <Head title="Search"/>

  <Layout>
    <section class="text-center pt-6">
      <h1 class="font-bold text-4xl">Let's Find Your Next Job</h1>
      <SearchJobForm :searchString @searchFormSubmitEvent="searchFormSubmit"/>
    </section>

    <heading>{{ ('Search results') }}</heading>

    <div class="border-t border-b py-4 mt-4 space-y-4">
      <div class="flex items-center gap-2">
        <span>Sort by:</span>
        <select name="" id="" v-model="order" class="text-black border-0">
          <option value="DESC">Newest</option>
          <option value="ASC">Oldest</option>
        </select>
      </div>
      <div class="flex items-center gap-2">
        <span>Tags:</span>
        <CheckboxButtons :items="props.tags.data" :selectedItems="tags" @checkboxCheckedEvent="checkboxFormSubmit" />
      </div>
    </div>

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
