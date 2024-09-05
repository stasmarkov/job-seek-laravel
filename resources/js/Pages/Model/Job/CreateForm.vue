<script setup>

import AdminAreaLayout from "@/Layouts/AdminAreaLayout.vue";
import Heading from "@/Components/Heading.vue";
import {useForm} from "@inertiajs/vue3";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import JobCardWide from "@/Components/Jobs/JobCardWide.vue";
import JobCard from "@/Components/Jobs/JobCard.vue";

const form = useForm({
  title: '',
  salary: '',
  location: '',
  schedule: 'Part-Time',
  url: '',
  tags: '',
  description: '',
  featured: false
});

const submit = () => {
  form.post(route('job.store'), {

    onFinish: () => {
      console.log(form);
    },
    onSuccess: () => {
      console.log(form);
      form.reset()
    }
  });
};
</script>

<template>
  <AdminAreaLayout>
    <Head title="Post a new job" />
    <Heading>
      Add a new Job!
    </Heading>
    <form @submit.prevent="submit" class="space-y-6">

      <div class="flex flex-wrap flex-col gap-4">
        <TextInput label="Title" name="title" v-model="form.title" placeholder="Laravel Developer"/>
        <InputError :message="form.errors.title" class="mt-2"/>

        <textarea name="description" v-model="form.description"/>
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
        <Checkbox label="Featured (Costs Extra)" name="featured" v-model:checked="form.featured"/>
        <InputLabel for="featured">Is this job should be featured?</InputLabel>
        <InputError :message="form.errors.featured" class="mt-2"/>
      </div>
      <div>
        <div class="bg-black/10 my-10 h-px w-full"></div>
      </div>


      <div class="flex flex-wrap flex-col gap-4">
        <TextInput label="URL" name="url" type="url" v-model="form.url" placeholder="https://acme.com/jobs.ceo-wanted"/>
        <InputError :message="form.errors.url" class="mt-2"/>

        <TextInput label="Tags (Comma separated)" name="tags" v-model="form.tags"
                   placeholder="laravel, symfony, education"/>
        <InputError :message="form.errors.tags" class="mt-2"/>
      </div>

      <div class="flex items-center gap-4">
        <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

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

    <section class="py-6">
      <JobCardWide :job="form" v-if="!form.featured"></JobCardWide>
      <JobCard :job="form" v-else></JobCard>
    </section>
  </AdminAreaLayout>

</template>
<style scoped>

</style>
