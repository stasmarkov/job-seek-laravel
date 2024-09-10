<script setup>
import Footer from "@/Components/Footer.vue";
import Header from "@/Components/Header.vue";
import Notification from "@/Components/Notification.vue";
import Alert from "@/Components/Banners/Alert.vue";
import BgBlur from "@/Components/BgBlur.vue";
</script>

<template>
  <div class="bg-black text-white overflow-hidden">
    <div class="pt-[5.125rem] flex flex-col justify-between">
      <!-- Page Header -->
      <div>
        <slot name="header">
          <Header/>
        </slot>
      </div>


      <!-- Page Heading -->
      <header class="shadow" v-if="$slots.heading">
        <div class="text-white w-full max-w-5xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
          <slot name="heading"/>
        </div>
      </header>

      <Alert/>
      <BgBlur />

      <!-- Page Content -->
      <main class="z-10 mt-12  w-full max-w-5xl mx-auto flex-1 px-4 sm:px-6 lg:px-8">
        <slot name="default"/>
      </main>

      <!-- Page Footer -->
      <slot name="footer">
        <Footer/>
      </slot>

      <BgBlur />
      <Notification/>
    </div>
  </div>
</template>
