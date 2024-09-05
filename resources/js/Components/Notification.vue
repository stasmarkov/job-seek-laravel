<script setup>

import {nextTick, reactive} from "vue";
import {useCurrentUser} from "@/Composables/useCurrentUser.js";

let messages = reactive({
  list: [],
});

let user = useCurrentUser();

const close = (index) => {
  messages.list[index].hide = true;
  setTimeout(() => {
    messages.list.splice(index, 1);
  }, 750);
};

// @todo Get list of channels from some centralized store.
Echo.private(`App.Models.User.${user.id}`)
  .notification((notification) => {
    messages.list.push({
      message: notification.message,
      hide: false,
    });
  });

</script>

<template>
  <div class="fixed bottom-2 right-2 scroll-auto" v-if="messages.list">
    <div
      v-for="(item, index) in messages.list"
      :key="index"
      class="mt-2 p-4 bg-blue-900 pr-12 relative"
      :class="{ 'animate-ping' : messages.list[index].hide === true}"
    >
      <span class="text-white" v-html="item.message" />
      <button
        @click="close(index)"
        class="bg-transparent ease-linear p-2 absolute top-0 right-0 rounded-3xl h-8 w-8 group"
      >
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" class="rotate-45 group-hover:scale-150 transition"><path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z"></path></svg>
      </button>
    </div>
  </div>
</template>
