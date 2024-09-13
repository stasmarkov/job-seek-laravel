<script setup>
import Layout from "@/Layouts/Layout.vue";
import CardWide from "@/Components/Models/Vacancies/CardWide.vue";
import SimpleSearchForm from "@/Components/Forms/SimpleSearchForm.vue";
import Pager from "@/Components/Pagers/Pager.vue";
import {ref, watch} from "vue";
import {router} from "@inertiajs/vue3";
import {throttle, debounce} from "lodash";
import CheckboxButtons from "@/Components/FormElements/CheckboxButtons.vue";
import Tag from "@/Components/Models/Tags/Tag.vue";
import Preview from "@/Components/Models/CandidateProfiles/Preview.vue";
import BlockHeading from "@/Components/Headings/BlockHeading.vue";

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
  router.get(route('search.candidates'), {order: orderValue, search: searchValue, tags: tagsValue}, {
    preserveState: true,
    preserveScroll: true,
    replace: true,
  })
}, 500))

</script>

<template>
  <Head title="Search"/>

  <Layout>
    <section class="text-center pt-6">
      <SimpleSearchForm
        type="keyup"
        :searchString
        @searchFormSubmitEvent="searchFormSubmit"
        title="Let's find Candidate"
      />
    </section>

    <BlockHeading>{{ ('Filter') }}</BlockHeading>

    <div class="border-t border-b py-4 mt-4 space-y-4">
      <div class="flex items-center gap-2">
        <span>Sort by:</span>
        <select name="" id="" v-model="order" class="text-black border-0">
          <option value="DESC">Newest</option>
          <option value="ASC">Oldest</option>
        </select>
      </div>
      <div class="flex items-center gap-2 flex-wrap">
        <span class="flex-1">Tagged by:</span>
        <CheckboxButtons class="p-0" :items="props.tags" :selectedItems="tags" @checkboxCheckedEvent="checkboxFormSubmit" />
      </div>
    </div>

    <BlockHeading>{{ ('Results') }}</BlockHeading>
    <div class="mt-4">
      <div v-if="props.results.data.length > 0">
        <div class="space-y-4">
          <Preview v-for="candidateProfile in props.results.data" :candidateProfile="candidateProfile" />
        </div>

        <Pager :links="props.results.meta.links"></Pager>
      </div>
      <div class="text-xl text-center" v-else>
        {{ ('Oops! No results found :\'(') }}
      </div>
    </div>
  </Layout>
</template>
