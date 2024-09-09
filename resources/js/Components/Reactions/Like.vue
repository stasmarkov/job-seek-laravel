<script setup>
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";
import { faHeart } from "@fortawesome/free-solid-svg-icons";
import { faHeart as faHeartRegular } from "@fortawesome/free-regular-svg-icons";

const props = defineProps({
  likesCount: Number,
  isLiked: Boolean,
  route: String,
});

defineEmits(['liked']);
</script>

<template>
  <div class="p-2">
    <Link :href="route" preserve-scroll>
      <font-awesome-icon v-if="isLiked" :icon="faHeart" class="text-blue-500" />
      <font-awesome-icon v-else :icon="faHeartRegular" class="text-blue-500" />
      Likes: {{ likesCount }}
    </Link>
  </div>
</template>
