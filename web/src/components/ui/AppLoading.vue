<template>
  <div
    v-if="visible"
    class="fixed inset-0 z-50 bg-[#00000096] bg-opacity-50 flex items-center justify-center"
  >
    <div class="w-12 h-12 border-4 border-white border-t-transparent rounded-full animate-spin"></div>
  </div>
</template>

<script setup lang="ts">
defineProps<{ visible: boolean }>();
</script>

<style scoped>

</style>