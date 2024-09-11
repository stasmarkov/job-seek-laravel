<script setup>
  import Layout from "@/Layouts/Layout.vue";
  import Panel from "@/Components/Panel.vue";
  import LinkButton from "@/Components/Buttons/LinkButton.vue";
  import EmployerProfileLogo from "@/Components/Models/Employers/EmployerProfileLogo.vue";
  import Tag from "@/Components/Models/Tags/Tag.vue";
  import AnchorButton from "@/Components/Buttons/AnchorButton.vue";
  import Like from "@/Components/Reactions/Like.vue";
  import {Inertia} from "@inertiajs/inertia";
  import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";
  import { faArrowUpRightFromSquare } from "@fortawesome/free-solid-svg-icons";

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
      <LinkButton class="bg-green-600" :href="route('job.edit', { job: props.job.data.id })">Edit</LinkButton>
    </div>

    <Panel :hoverable="false">
      <div class="text-white">
        <div class="px-4 sm:px-0">
          <div class="flex justify-between">
            <h3 class="text-base font-semibold leading-7">

              <span class="text-3xl font-bold">{{ props.job.data.title }}</span>
            </h3>
            <EmployerProfileLogo :employerProfile="props.job.data.employerProfile" width="50"/>
          </div>

          <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">Employer: <Link v-if="props.job.data.employerProfile" class="self-start text-sm text-gray-200 hover:underline hover:text-blue-500 ease-linear transition" :href="route('employer_profile.show', { employerProfile: props.job.data.employerProfile.id })">{{ props.job.data.employerProfile.name }}</Link></p>
        </div>
        <div class="mt-6 border-t border-gray-100">
          <dl class="divide-y divide-gray-100">
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
              <dt class="text-sm font-medium leading-6">Salary</dt>
              <dd class="mt-1 text-sm leading-6 text-gray-300 sm:col-span-2 sm:mt-0">{{ job.data.salary  }}</dd>
            </div>
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
              <dt class="text-sm font-medium leading-6 text-gray-100">Schedule</dt>
              <dd class="mt-1 text-sm leading-6 text-gray-300 sm:col-span-2 sm:mt-0">{{ props.job.data.schedule }}</dd>
            </div>
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
              <dt class="text-sm font-medium leading-6 text-gray-100">Location</dt>
              <dd class="mt-1 text-sm leading-6 text-gray-300 sm:col-span-2 sm:mt-0">{{ props.job.data.location }}</dd>
            </div>
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
              <dt class="text-sm font-medium leading-6 text-gray-100">Description</dt>
              <dd class="mt-1 text-sm leading-6 text-gray-300 sm:col-span-2 sm:mt-0">
                {{ props.job.data.description }}
              </dd>
            </div>
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
              <dt class="text-sm font-medium leading-6 text-gray-100">Tags</dt>
              <dd class="mt-2 text-sm text-gray-100 sm:col-span-2 sm:mt-0">
                <div class="flex flex-wrap mt-auto gap-2">
                  <Tag v-for="tag in props.job.data.tags" size="small" :tag/>
                </div>
              </dd>
            </div>
          </dl>
        </div>
      </div>

      <div class="mt-4 flex justify-end">
        <Like :route="route('job.like', {'job': props.job.data.id })" :likesCount="props.likesCount" :isLiked="props.isLiked" />
        <AnchorButton :href="props.job.data.url" target="_blank">View more</AnchorButton>
      </div>
    </Panel>

  </Layout>
</template>

<style scoped>

</style>
