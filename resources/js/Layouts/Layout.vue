<script setup>
import Footer from "@/Components/Sections/Footer.vue";
import Header from "@/Components/Sections/Header.vue";
import Notification from "@/Components/Notification.vue";
import Alert from "@/Components/Banners/Alert.vue";
import BgBlur from "@/Components/VisualEffects/BgBlur.vue";
</script>

<template>
  <Head>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
  </Head>
  <div class="bg-black text-white overflow-hidden min-h-screen">
    <div class="pt-[5.125rem] flex flex-col justify-between min-h-screen">
      <!-- Page Header -->
      <div>
        <slot name="header">
          <Header/>
        </slot>
      </div>


      <!-- Page BlockHeading -->
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
