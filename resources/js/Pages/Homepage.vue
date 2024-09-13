<script setup>

import Layout from "@/Layouts/Layout.vue";
import BlockHeading from "@/Components/Headings/BlockHeading.vue";
import Card from "@/Components/Models/Vacancies/Card.vue";
import CardWide from "@/Components/Models/Vacancies/CardWide.vue";
import Tag from "@/Components/Models/Tags/Tag.vue";
import LinkButton from "@/Components/Buttons/LinkButton.vue";
import SimpleSearchForm from "@/Components/Forms/SimpleSearchForm.vue";
import {Head, useForm} from '@inertiajs/vue3';
import { Inertia } from "@inertiajs/inertia";

// Properties given by the route should be defined using defineProps.
defineProps({
  featuredVacancies: {
    type: Object
  },
  vacancies: {
    type: Object
  },
  tags: {
    type: Object,
  }
});

function redirectOnSearchPage(value) {
  Inertia.get(route('search.vacancies', {'search': value}));
}

</script>

<template>
  <Head title="Homepage" />
  <Layout>
    <div class="space-y-4">
      <section>
        <section class="text-center pt-6">
          <SimpleSearchForm type="submit" @searchFormSubmitEvent="redirectOnSearchPage"/>
        </section>

        <BlockHeading>Featured vacancies</BlockHeading>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8 mt-6">
          <Card v-for="vacancy in featuredVacancies" :vacancy />
        </div>
      </section>

      <section>
        <BlockHeading>Tags</BlockHeading>
        <div class="mt-6 gap-2 flex flex-wrap">
          <Tag v-for="tag in tags" :tag size="base" />
        </div>
      </section>

      <section class="mt-6 space-y-6">
        <BlockHeading>Recent vacancies</BlockHeading>
        <CardWide v-for="vacancy in vacancies" :vacancy />

        <div class="flex justify-center mt-2">
          <LinkButton :href="route('search.vacancies')">{{ ('View more') }}</LinkButton>
        </div>
      </section>
    </div>
  </Layout>
</template>
