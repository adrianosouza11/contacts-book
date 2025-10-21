<template>
  <div v-if="show" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
    <div class="bg-white rounded-xl p-6 shadow-lg w-full max-w-2xl">
      <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold"> {{ title }}</h2>
        <button @click="emit('close')" class="text-gray-400 hover:text-black">✖</button>
      </div>
      <div>
        <slot />
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { defineEmits } from 'vue';

defineProps({
  show: Boolean,
  title: String
});

const emit = defineEmits(['close']);
</script>
<style scoped>

</style>