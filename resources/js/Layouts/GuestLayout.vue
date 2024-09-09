<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
</script>

<template>
  <div class="min-h-screen flex">
    <div class="flex min-h-full flex-1 flex-col justify-center px-6 py-12 lg:px-8">
      <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <Link href="/">
          <ApplicationLogo class="mx-auto h-10 w-auto fill-current text-gray-500"/>
        </Link>

        <h2 v-if="$slots.heading" class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">
          <slot name="heading"></slot>
        </h2>
      </div>

      <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <slot/>
      </div>
    </div>
  </div>

</template>
