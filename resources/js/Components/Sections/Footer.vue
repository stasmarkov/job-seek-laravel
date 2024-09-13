<script setup>

import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import RegularLink from "@/Components/Elements/RegularLink.vue";
</script>

<template>
  <footer class="pt-12  border-t border-white/20 min-h-10 mt-10 py-10 z-10">

    <div class="max-w-5xl border-white/20 mx-auto border-b pb-4 mb-8 flex gap-6 flex-wrap flex-col md:flex-row px-6">
      <div class="md:basis-56 basis-full">
        <Link class="flex justify-center" :href="route('homepage')">
          <ApplicationLogo class="flex justify-center" />
        </Link>

        <div class="mt-4 text-center text-xs">
          <p>The easiest way to hire or apply!</p>
        </div>
      </div>
      <div class="flex gap-6 flex-wrap">
       <ul class="space-y-2">
         <li><RegularLink :href="route('homepage')">Homepage</RegularLink></li>
         <li><RegularLink :href="route('contact.index')">Contact us</RegularLink></li>
         <li><RegularLink :href="route('homepage')">FAQ</RegularLink></li>
       </ul>
        <ul>
          <li><RegularLink :href="route('search.vacancies')">Vacancies</RegularLink></li>
          <li><RegularLink :href="route('search.vacancies')">Candidates</RegularLink></li>
        </ul>
      </div>
    </div>

    <div class="max-w-5xl mx-auto">
      <div class="text-center">
        <p>Copyright ©{{ new Date().getFullYear() }} - Developed by <a href="https://www.linkedin.com/in/stanislav-markov-179947103/" class="text-blue-400 hover:underline" target="_blank">Stas Markov</a></p>
      </div>
    </div>
  </footer>
</template>

<style scoped>
</style>
