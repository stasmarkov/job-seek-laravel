<script setup>

import {faArrowUpRightFromSquare} from "@fortawesome/free-solid-svg-icons";
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";

const props = defineProps({
  href: String,
  target: String,
});

const isExternalURL = (url) => new URL(url).origin !== location.origin;

</script>

<template>
  <a
    :href="props.href"
    :target="props.target"
    class="inline-flex items-center px-4 py-2 bg-blue-700 border border-transparent rounded-3xl font-semibold text-sm text-white tracking-widest hover:bg-blue-500 focus:bg-gray-700 active:bg-gray-900 transition ease-linear duration-300"
  >
    <slot/>
    <font-awesome-icon class="ml-2" v-if="isExternalURL(props.href)" :icon="faArrowUpRightFromSquare" />
  </a>
</template>
