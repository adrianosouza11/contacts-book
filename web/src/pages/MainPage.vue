<template>
    <AppLayout>
      <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
        <span class="font-semibold mb-6">Lista de Contatos</span>
      </div>
    </AppLayout>
</template>

<script setup lang="ts">
import { useRouter } from 'vue-router';
import AppLayout from '@/layouts/AppLayout.vue';
const router = useRouter();

</script>