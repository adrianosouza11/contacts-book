<template>
  <header class="h-16 text-white bg-[#26313c] border-b px-6 flex items-center justify-between">
    <h1 class="text-lg font-semibold">Contacts Book</h1>
    <div class="flex gap-2 items-center"> 
      <button
        v-for="lang in langs"
        :key="lang"
        @click="setLanguage(lang)"
        class="px-3 py-1 border rounded"
        :class="{ 'bg-blue-500 text-white': locale === lang }"
      >
      {{ lang.toUpperCase() }}
    </button>
    </div>
      
  </header>
</template>

<script setup lang="ts">
import { useLanguageStore } from '@/stores/languageStore';
import { storeToRefs } from 'pinia';

const store = useLanguageStore();
const { locale } = storeToRefs(store);

const { setLanguage } = store;

const langs = ['en', 'pt'];
</script>

<style scoped></style>