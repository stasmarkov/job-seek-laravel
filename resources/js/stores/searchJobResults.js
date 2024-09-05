import {computed, reactive, ref} from "vue";

export default function useSearchJobResults() {
  const results = ref({});

  const getResults = async(page, q = '_all') => {
    axios.post(route('search.results', {
      'page': page,
      'q': q
    })).then(response => {
        results.value = response.data;
      })
  };

  return { results, getResults }
}
