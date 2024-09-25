<script setup>

import {useForm, usePage} from "@inertiajs/vue3";
import InputLabel from "@/Components/FormElements/InputLabel.vue";
import TextInput from "@/Components/FormElements/TextInput.vue";
import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";
import Checkbox from "@/Components/FormElements/Checkbox.vue";
import InputError from "@/Components/FormElements/InputError.vue";
import CardWide from "@/Components/Models/Vacancies/CardWide.vue";
import Card from "@/Components/Models/Vacancies/Card.vue";
import {computed, ref} from "vue";
import HtmlTextarea from "@/Components/FormElements/HtmlTextarea.vue";
import useCharsCounter from "@/stores/charsCounter.js";
import CheckboxButtons from "@/Components/FormElements/CheckboxButtons.vue";
import {useCurrentUser} from "@/Composables/useCurrentUser.js";
import TextareaInput from "@/Components/FormElements/TextareaInput.vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import InputWrapper from "@/Components/FormElements/InputWrapper.vue";

const props = defineProps({
  vacancy: Object,
  employerProfile: Object,
  tags: Array,
});

let enablePreview = ref(false);

const form = useForm({
  title: props.vacancy.title,
  salary: props.vacancy.salary,
  location: props.vacancy.location,
  schedule: props.vacancy.schedule,
  url: props.vacancy.url,
  tags: props.vacancy.tags.map(el => el.id),
  description: props.vacancy.description,
  short_description: props.vacancy.short_description,
  featured: Boolean(props.vacancy.featured)
});

const user = useCurrentUser();

// Vacancy passed to the preview.
const vacancy = computed(() => {
  return {
    created_at: props.vacancy.created_at,
    title: form.title,
    salary: form.salary,
    location: form.location,
    schedule: form.schedule,
    url: form.url,
    tags: form.tags.map(tagId => {
      let tag = props.tags.find(el => el.id === tagId);
      return {
        'id': tag.id,
        'name': tag.name,
      }
    }),
    description: form.description,
    short_description: form.short_description,
    employerProfile: props.employerProfile,
  };
});

let {getCharsLeft} = useCharsCounter();
let limitChars = computed(function () {
  return getCharsLeft(250, form.short_description);
});

// The callback on search.
function checkboxFormSubmit(value) {
  form.tags = value;
}

// The form submission.
const submit = () => {
  form.patch(route('vacancy.update', {vacancy: props.vacancy.id}));
};
</script>

<template>
  <AdminLayout>
    <Head title="Edit vacancy" />

    <template #heading>Edit vacancy: {{ props.vacancy.title }}</template>

    <div :class="{
      'sm:grid-cols-1': !enablePreview
    }">
      <div class="flex gap-2 items-center">
        <Checkbox :checked="enablePreview" id="preview" name="preview" @input="enablePreview = ! enablePreview"/>
        <InputLabel for="preview" value="Enable preview"/>
      </div>
      <form @submit.prevent="submit" class="space-y-6 mt-4">
        <div class="flex flex-wrap flex-col gap-4">
          <InputWrapper id="title" label="Vacancy title" :message="form.errors.title">
            <TextInput
              id="title"
              type="text"
              class="mt-1 block w-full"
              v-model="form.title"
              required
              autofocus
              placeholder="Sr. Laravel Developer..."
            />
          </InputWrapper>

          <InputWrapper id="short_description" label="Vacancy short description" :message="form.errors.short_description">
            <HtmlTextarea
              name="short_description"
              v-model="form.short_description"
            />
            <span class="flex w-full justify-end" :class="{
              'text-red-500': charsLeft <= 0,
            }">{{ charsLeft }} / 250</span>
          </InputWrapper>

          <InputWrapper id="description" label="Vacancy description" :message="form.errors.description">
            <HtmlTextarea
              name="description"
              v-model="form.description"
            />
          </InputWrapper>
        </div>
        <div>
          <div class="bg-black/10 my-10 h-px w-full"></div>
        </div>
        <div class="info flex gap-4">
          <InputWrapper class="flex-grow-0" id="salary" label="Salary" :message="form.errors.salary">
            <TextInput label="Salary" name="salary" v-model="form.salary" placeholder="$60,000 USD"/>
          </InputWrapper>

          <InputWrapper class="flex-grow-0" id="salary" label="Location" :message="form.errors.location">
            <TextInput name="location" v-model="form.location" placeholder="Port City, Lutsk"/>
          </InputWrapper>
        </div>

        <InputWrapper id="schedule" label="Schedule" :message="form.errors.schedule">
          <select name="schedule" v-model="form.schedule">
            <option value="Part-Time">Part Time</option>
            <option value="Full-Time">Full Time</option>
            <option value="Contract">Contract</option>
          </select>
        </InputWrapper>


        <div class="flex items-center align-middle gap-2">
          <Checkbox label="Featured (Costs Extra)" id="featured" name="featured" v-model:checked="form.featured"/>
          <InputLabel for="featured">Is this vacancy should be featured?</InputLabel>
          <InputError :message="form.errors.featured" class="mt-2"/>
        </div>
        <div>
          <div class="bg-black/10 my-10 h-px w-full"></div>
        </div>


        <div class="flex flex-wrap flex-col gap-4">
          <TextInput label="URL" name="url" type="url" v-model="form.url"
                     placeholder="https://acme.com/jobs.ceo-wanted"/>
          <InputError :message="form.errors.url" class="mt-2"/>

          <CheckboxButtons
            :items="props.tags"
            :selectedItems="form.tags"
            type="admin"
            @checkboxCheckedEvent="checkboxFormSubmit"/>
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

    <div v-if="enablePreview" class="mt-4">
      <CardWide :vacancy="vacancy" v-if="!form.featured"></CardWide>
      <Card :vacancy="vacancy" v-else></Card>
    </div>

  </AdminLayout>

</template>
<style scoped>

</style>
