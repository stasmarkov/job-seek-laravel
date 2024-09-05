import {ref} from "vue";

export default function useCharsCounter () {
  let limitChars = ref(0);

  function getCharsLeft(limit = 0, text) {
    limitChars.value = limit - text.length
    return limitChars;
  }

  return { limitChars, getCharsLeft }
}
