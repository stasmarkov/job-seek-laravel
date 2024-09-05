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
      <div class="max-w-5xl lg:w-6xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <slot name="heading"/>
      </div>
    </header>

    <!-- Page Content -->
    <main class="pt-12 max-w-5xl w-full mx-auto px-4 sm:px-6 lg:px-8 grid gap-6" :class="{
      'sm:grid-cols-2 max-w-full' : $slots.left_column && $slots.right_column,
    }">
      <section v-if="$slots.left_column">
        <slot name="left_column" />
      </section>
      <section v-if="$slots.right_column">
        <slot name="right_column" />
      </section>
    </main>

    <slot />

    <slot name="footer">
      <Footer class="text-white bg-black"/>
    </slot>
  </div>
</template>
