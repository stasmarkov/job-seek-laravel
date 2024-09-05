<script setup>
import Footer from "@/Components/Footer.vue";
import Header from "@/Components/Header.vue";
</script>

<template>
  <div class="px-10 pt-16 flex flex-col h-screen justify-between">
    <!-- Page Header -->
    <div>
      <slot name="header">
        <Header />
      </slot>
    </div>

    <!-- Page Heading -->
    <header class="shadow" v-if="$slots.heading">
      <div class="text-white max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <slot name="heading"/>
      </div>
    </header>

    <!-- Page Content -->
    <main class="mt-12 max-w-7xl mx-auto flex-1">
      <slot name="default" />
    </main>

    <!-- Page Footer -->
    <div>
      <slot name="footer">
        <Footer />
      </slot>
    </div>
  </div>
</template>
