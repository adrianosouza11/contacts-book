<template>
  <router-view />
  <AppLoading :visible="isLoading" />
</template>

<script setup lang="ts">
import { useLoading } from '@/composables/useLoading';
import AppLoading from '@/components/ui/AppLoading.vue'

const { isLoading } = useLoading();
</script>