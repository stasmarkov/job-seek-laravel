<script setup>

import Header from "@/Components/Sections/Header.vue";
</script>

<template>
  <div class="bg-black text-white overflow-hidden min-h-screen">
    <!-- Page Content -->
    <div class="pt-[5.125rem] flex flex-col justify-between min-h-screen">
      <!-- Page Header -->
      <div>
        <slot name="header">
          <Header/>
        </slot>
      </div>
      <main class="z-10 mt-12  w-full max-w-5xl mx-auto flex-1 px-4 sm:px-6 lg:px-8 flex items-center flex-col">
        <slot name="default"/>
      </main>
    </div>
  </div>
</template>
