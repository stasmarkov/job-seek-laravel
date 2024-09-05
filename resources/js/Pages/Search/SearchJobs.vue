<script setup>
import Layout from "@/Layouts/Layout.vue";
import Heading from "@/Components/Heading.vue";
import JobCardWide from "@/Components/Jobs/JobCardWide.vue";
import SearchJobForm from "@/Components/Forms/SearchJobForm.vue";
import Pager from "@/Components/Pager.vue";
import {ref, watch} from "vue";
import {router} from "@inertiajs/vue3";
import { throttle, debounce } from "lodash";

// Properties given from controller and parent components.
const props = defineProps({
  results: Object,
  filters: Object,
  tags: Object,
});

// The search string.
let searchString = ref(props.filters.search ?? '');
let order = ref(props.filters.order ?? 'DESC');
let tags = ref(props.filters.tags?.data ?? []);

// The callback on search.
function searchFormSubmit(searchSubmitValue) {
  searchString.value = searchSubmitValue;
}

// throttle - Makes request with some period.
// debounce - Makes request after some period.
watch([order, searchString, tags], throttle(function ([orderValue, searchValue, tagsValue]) {
  router.get('/search', { order: orderValue, search: searchValue, tags: tagsValue }, {
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
        <div class="flex flex-wrap gap-2">
           <span v-for="tag in props.tags.data">
          <input type="checkbox" :id="tag.id" :value="tag.id" v-model="tags" class="hidden"/>
          <label
            :for="tag.id"
            class="hover:cursor-pointer rounded-2xl font-bold transition-colors duration-300 text-white px-5 py-1 text-sm"
            :class="{
              'bg-blue-500 hover:bg-blue-400' : tags.find(el => Number(el) === Number(tag.id)),
              'bg-white/10 hover:bg-white/25' : !tags.find(el => Number(el) === Number(tag.id)),
            }"
          >{{ tag.name }}</label>
        </span>
        </div>
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
