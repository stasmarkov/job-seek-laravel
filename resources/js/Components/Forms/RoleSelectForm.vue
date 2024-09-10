<script setup>

import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";
import Divider from "@/Components/FormElements/Divider.vue";
import {useForm} from "@inertiajs/vue3";

const roles = [
  {
    id: 'employer',
    title: 'Employer',
    description: 'Lorem ipsum dolor sit amet consectetur adipiscing elit donec nascetur, natoque convallis luctus rhoncus nec libero id eros tellus placerat',
  },
  {
    id: 'employee',
    title: 'Employee',
    description: 'Id inceptos imperdiet velit ac vestibulum nibh pulvinar viverra est accumsan etiam pellentesque, mattis semper dictum mi sagittis tortor ad orci malesuada litora <b>sed</b>.',
  },
];

const form = useForm({
  role: '',
})
</script>

<template>
  <Divider />

  <form @submit.prevent="form.post(route('profile.role_select.update'))">
    <div class="cards flex gap-2">
      <div class="flex-1" v-for="(role) in roles">
        <input v-model="form.role" type="radio" name="role" :value="role.id" :id="role.id" class="sr-only peer" required />
        <label :for="role.id"
               class="card block flex-1 border p-4 hover:cursor-pointer transition-all ease-linear
               peer-checked:border-blue-200 peer-checked:text-blue-500">
          <span>
            <span class="header border-b pb-2 block">
              <span class="text-center">{{ role.title }}</span>
            </span>
            <span class="description block mt-2" v-html="role.description"></span>
          </span>
        </label>
      </div>
    </div>

    <Divider />

    <div class="flex justify-center">
      <PrimaryButton class="w-full text-center justify-center">
        Select
      </PrimaryButton>
    </div>

  </form>
</template>

<style scoped>

</style>
