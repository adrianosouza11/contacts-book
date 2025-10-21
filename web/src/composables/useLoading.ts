import { ref } from 'vue';

const isLoading = ref(false);

export function useLoading() {
  function loadingStart() {
    isLoading.value = true;
  }

  function loadingStop() {
    isLoading.value = false;
  }

  return {
    isLoading,
    loadingStart,
    loadingStop,
  }
}