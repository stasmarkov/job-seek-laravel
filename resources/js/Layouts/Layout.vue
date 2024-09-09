<script setup>
import Footer from "@/Components/Footer.vue";
import Header from "@/Components/Header.vue";
import Notification from "@/Components/Notification.vue";
import Alert from "@/Components/Banners/Alert.vue";
</script>

<template>
  <div class="pt-[4.375rem] flex flex-col h-screen justify-between">
    <!-- Page Header -->
    <div>
      <slot name="header">
        <Header />
      </slot>
    </div>

    <!-- Page Heading -->
    <header class="shadow" v-if="$slots.heading">
      <div class="text-white w-full max-w-5xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <slot name="heading"/>
      </div>
    </header>

    <Alert />

    <!-- Page Content -->
    <main class="mt-12  w-full max-w-5xl mx-auto flex-1 px-4 sm:px-6 lg:px-8">
      <slot name="default" />
    </main>

    <!-- Page Footer -->
    <div>
      <slot name="footer">
        <Footer />
      </slot>
    </div>

    <Notification />
  </div>
</template>
