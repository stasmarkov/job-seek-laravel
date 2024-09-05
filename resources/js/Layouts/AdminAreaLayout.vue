<script setup>
import Header from "@/Components/Header.vue";
import Footer from "@/Components/Footer.vue";
</script>

<template>
  <Head title="Admin Area" />

  <div class="pt-16 bg-white text-gray-900 flex flex-col h-min-screen justify-between">
    <slot name="header">
      <Header />
    </slot>

    <!-- Page Heading -->
    <header class="border-b border-gray-100" v-if="$slots.heading">
      <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <slot name="heading"/>
      </div>
    </header>

    <!-- Page Content -->
    <main class="pt-12 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
      <slot name="default" />
    </main>

    <slot name="footer">
      <Footer class="text-white bg-black"/>
    </slot>
  </div>
</template>
