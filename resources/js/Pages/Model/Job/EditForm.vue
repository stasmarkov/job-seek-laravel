<script setup>

import {useForm, usePage} from "@inertiajs/vue3";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import JobCardWide from "@/Components/Jobs/JobCardWide.vue";
import JobCard from "@/Components/Jobs/JobCard.vue";
import {computed, ref} from "vue";
import AdminAreaTwoColumnsLayout from "@/Layouts/AdminAreaTwoColumnsLayout.vue";
import HtmlTextarea from "@/Components/FormElements/HtmlTextarea.vue";
import useCharsCounter from "@/stores/charsCounter.js";

const props = defineProps({
  job: Object,
  employer: Object,
});

let enablePreview = ref(false);

const form = useForm({
  title: props.job.data.title,
  salary: props.job.data.salary,
  location: props.job.data.location,
  schedule: props.job.data.schedule,
  url: props.job.data.url,
  tags: props.job.data.tags.map(tag => {
    return tag.name
  }).toString(),
  description: props.job.data.description,
  short_description: props.job.data.short_description,
  featured: props.job.data.featured
});

const user = usePage().props.auth.user;

const job = computed(() => {
  return {
    title: form.title,
    salary: form.salary,
    location: form.location,
    schedule: form.schedule,
    url: form.url,
    tags: form.tags.split(',').map(item => {
      return {'name': item}
    }),
    description: form.description,
    short_description: form.short_description,
    employer: user.employer,
  };
});

// // The chars counter functionality.
// const charsLeft = computed(() => {
//   return 250 - form.short_description.length
// });

let { getCharsLeft } = useCharsCounter();
let limitChars = computed(function() {
  return getCharsLeft(250, form.short_description);
});

// The form submission.
const submit = () => {
  form.patch(route('job.update', { job: props.job.data.id }));
};
</script>

<template>
  <AdminAreaTwoColumnsLayout>
    <Head title="Edit job"/>

    <template #heading>Edit job: {{ props.job.data.title }}</template>

    <template #left_column :class="{
      'sm:grid-cols-1': !enablePreview
    }">
      <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <div class="flex gap-2 items-center">
          <Checkbox :checked="enablePreview" id="preview" name="preview" @input="enablePreview = ! enablePreview" />
          <InputLabel for="preview" value="Enable preview" />
        </div>
        <form @submit.prevent="submit" class="space-y-6 mt-4">
          <div class="flex flex-wrap flex-col gap-4">
            <TextInput label="Title" name="title" v-model="form.title" placeholder="Laravel Developer"/>
            <InputError :message="form.errors.title" class="mt-2"/>

            <InputLabel value="Short description" for="short_description" />
            <textarea name="short_description" v-model="form.short_description"/>
            <span class="flex w-full justify-end" :class="{
              'text-red-500': limitChars <= 0,
            }">{{ limitChars }} / 250</span>

            <InputLabel value="Full description" for="description" />
            <HtmlTextarea
              name="description"
              v-model="form.description"
            />
            <InputError :message="form.errors.description" class="mt-2"/>
          </div>
          <div>
            <div class="bg-black/10 my-10 h-px w-full"></div>
          </div>
          <div class="info flex gap-4">
            <TextInput label="Salary" name="salary" v-model="form.salary" placeholder="$60,000 USD"/>
            <InputError :message="form.errors.salary" class="mt-2"/>

            <TextInput label="Location" name="location" v-model="form.location" placeholder="Port City, Lutsk"/>
            <InputError :message="form.errors.location" class="mt-2"/>
          </div>

          <select name="schedule" v-model="form.schedule">
            <option value="Part-Time">Part Time</option>
            <option value="Full-Time">Full Time</option>
            <option value="Contract">Contract</option>
          </select>
          <InputError :message="form.errors.schedule" class="mt-2"/>


          <div class="flex align-middle gap-2">
            <Checkbox label="Featured (Costs Extra)" id="featured" name="featured" v-model:checked="form.featured"/>
            <InputLabel for="featured">Is this job should be featured?</InputLabel>
            <InputError :message="form.errors.featured" class="mt-2"/>
          </div>
          <div>
            <div class="bg-black/10 my-10 h-px w-full"></div>
          </div>


          <div class="flex flex-wrap flex-col gap-4">
            <TextInput label="URL" name="url" type="url" v-model="form.url"
                       placeholder="https://acme.com/jobs.ceo-wanted"/>
            <InputError :message="form.errors.url" class="mt-2"/>

            <TextInput label="Tags (Comma separated)" name="tags" v-model="form.tags"
                       placeholder="laravel, symfony, education"/>
            <InputError :message="form.errors.tags" class="mt-2"/>
          </div>

          <div class="flex items-center gap-4">
            <PrimaryButton :disabled="form.processing">Update</PrimaryButton>

            <Transition
              enter-active-class="transition ease-in-out"
              enter-from-class="opacity-0"
              leave-active-class="transition ease-in-out"
              leave-to-class="opacity-0"
            >
              <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
            </Transition>
          </div>
        </form>
      </div>
    </template>

    <template #right_column v-if="enablePreview">
      <JobCardWide :job="job" v-if="!form.featured"></JobCardWide>
      <JobCard :job="job" v-else></JobCard>
    </template>

  </AdminAreaTwoColumnsLayout>

</template>
<style scoped>

</style>
