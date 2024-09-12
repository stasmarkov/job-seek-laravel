<script setup>

import {useForm, usePage} from "@inertiajs/vue3";
import InputLabel from "@/Components/FormElements/InputLabel.vue";
import TextInput from "@/Components/FormElements/TextInput.vue";
import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";
import Checkbox from "@/Components/FormElements/Checkbox.vue";
import InputError from "@/Components/FormElements/InputError.vue";
import CardWide from "@/Components/Models/Jobs/CardWide.vue";
import Card from "@/Components/Models/Jobs/Card.vue";
import {computed, ref} from "vue";
import HtmlTextarea from "@/Components/FormElements/HtmlTextarea.vue";
import CheckboxButtons from "@/Components/FormElements/CheckboxButtons.vue";
import {useCurrentUser} from "@/Composables/useCurrentUser.js";
import FormGroup from "@/Components/FormElements/FormGroup.vue";
import TextareaInput from "@/Components/FormElements/TextareaInput.vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";

const props = defineProps({
  employerProfile: Object,
  tags: Object,
});

// The form object.
const form = useForm({
  title: '',
  salary: '',
  location: '',
  schedule: 'Part-Time',
  url: '',
  tags: [],
  description: '',
  short_description: '',
  featured: false
});


// Get current user.
const user = useCurrentUser();

// Enable/disable preview.
let enablePreview = ref(false);

// Job passed to the preview.
// @todo Find better way to extract tags.
const job = computed(() => {
  return {
    title: form.title,
    salary: form.salary,
    location: form.location,
    schedule: form.schedule,
    url: form.url,
    tags: form.tags.map(item => {
      if (item instanceof Object) {
        return item;
      }
      let tag = props.tags.find(el => el.id === item);
      return {
        'id': tag.id,
        'name': tag.name,
      }
    }),
    description: form.description,
    short_description: form.short_description,
    employerProfile: user.employerProfile,
  };
});

// The chars counter functionality.
const charsLeft = computed(() => {
  return 250 - form.short_description.length
});

// The callback on search.
function checkboxFormSubmit(value) {
  form.tags = value;
}

// The form submission.
const submit = () => {
  form.post(route('job.store'), {
    onSuccess: () => {
      form.reset()
    }
  });
};
</script>

<template>
  <AdminLayout>
    <Head title="Post a new job"/>

    <template #heading>Add new job</template>

    <div :class="{
      'sm:grid-cols-1': !enablePreview
    }">
      <div class="flex gap-2 items-center">
        <Checkbox :checked="enablePreview" id="preview" name="preview" @input="enablePreview = ! enablePreview"/>
        <InputLabel for="preview" value="Enable preview"/>
      </div>
      <form @submit.prevent="submit" class="space-y-6 mt-4">
        <div class="flex flex-wrap flex-col gap-4">
          <TextInput label="Title" name="title" v-model="form.title" placeholder="Laravel Developer"/>
          <InputError :message="form.errors.title" class="mt-2"/>

          <InputLabel value="Short description" for="short_description"/>
          <TextareaInput name="short_description" v-model="form.short_description"/>

          <span class="flex w-full justify-end" :class="{
              'text-red-500': charsLeft <= 0,
            }">{{ charsLeft }} / 250</span>

          <InputLabel value="Full description" for="description"/>
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


        <div class="flex items-center align-middle gap-2">
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

          <CheckboxButtons :items="props.tags" :selectedItems="form.tags" type="admin"
                           @checkboxCheckedEvent="checkboxFormSubmit"/>

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
    </div>

    <template #right_column v-if="enablePreview">
      <CardWide :job="job" v-if="!form.featured"></CardWide>
      <Card :job="job" v-else></Card>
    </template>

  </AdminLayout>

</template>
<style scoped>

</style>
