import {computed, reactive, ref} from "vue";

export default function useSearchJobResults() {
  const results = ref({});

  const getResults = async(page) => {
    axios.get(route('search.results', {
      'page': page,
    }))
      .then(response => {
        results.value = response.data;
      })
  };

  return { results, getResults }
}
