<script setup lang="ts">
import Sidebar from '@/components/Sidebar.vue';
import Header from '@/components/Header.vue';
</script>

<template>
  <div class="flex h-screen bg-gray-100">
    <div class="flex flex-col flex-1">
      <Header />
      <main class="flex-1 overflow-y-auto p-6">
        <slot />
      </main>
    </div>
  </div>
</template>

<style scoped>

</style>