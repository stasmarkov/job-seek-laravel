<script setup>
import Layout from "@/Layouts/Layout.vue";
import Heading from "@/Components/Heading.vue";
import JobCardWide from "@/Components/Jobs/JobCardWide.vue";
import {TailwindPagination} from 'laravel-vue-pagination';
import useSearchJobResults from "@/stores/searchJobResults.js";
import SearchJobForm from "@/Components/Forms/SearchJobForm.vue";

let {results, getResults} = useSearchJobResults();

</script>

<template>
  <Layout>
    <section class="text-center pt-6">
      <h1 class="font-bold text-4xl">Let's Find Your NExt Job</h1>
      <SearchJobForm />
    </section>

    <heading>{{ ('Search results') }}</heading>


    <div class="space-y-3">
<!--      <div v-if="results.data && results.data.length > 0">-->
        <JobCardWide v-for="job in results.data" :job :key="job.id"/>

        <div class="pager mt-6 flex justify-center">
          <TailwindPagination
            :data="results"
            @pagination-change-page="getResults"
          />
        </div>
<!--      </div>-->
<!--      <div class="text-xl text-center" v-else>-->
<!--        {{ ('Oops! No results found :\'(') }}-->
<!--      </div>-->
    </div>
  </Layout>
</template>
