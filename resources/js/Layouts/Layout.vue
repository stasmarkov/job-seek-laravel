<script setup>
import Footer from "@/Components/Footer.vue";
import Header from "@/Components/Header.vue";
</script>

<template>
  <div class="px-10 pt-16">
    <slot name="header">
      <Header />
    </slot>
    <main class="mt-12 max-w-7xl mx-auto">
      <slot />
    </main>

    <slot name="footer">
      <Footer />
    </slot>
  </div>
</template>
