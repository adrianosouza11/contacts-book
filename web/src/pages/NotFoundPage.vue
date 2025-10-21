<template>
  <div class="min-h-screen flex flex-col items-center justify-center text-center p-6">
    <h1 class="text-6xl font-bold text-red-600 mb-4">404</h1>
    <p class="text-xl text-gray-700 mb-6">Página não encontrada.</p>
    <router-link
        to="/"
        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition"
    >
      Voltar para o início
    </router-link>
  </div>
</template>

<script setup lang="ts"></script>