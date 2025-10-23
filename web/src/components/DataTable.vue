<template>
  <div class="p-6 bg-white rounded-2xl shadow-md">
    <!-- Título -->
    <h2 class="text-2xl font-semibold mb-6">{{ title }}</h2>
    <!-- Filtros -->
    <div class="flex flex-col md:flex-row md:items-end gap-4 mb-6">
      <div>
        <label for="filter-id" class="block text-sm font-medium text-gray-700 mb-1">Filtrar por ID</label>
        <input type="text" id="filter-id" class="w-full md:w-64 border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Digite o ID" />
      </div>

      <div>
        <label for="filter-date" class="block text-sm font-medium text-gray-700 mb-1">Filtrar por Data</label>
        <input type="date" id="filter-date" class="w-full md:w-64 border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
      </div>
    </div>

    <!-- Tabela -->


    <!-- Paginação -->
    <div class="flex flex-col md:flex-row items-center justify-between mt-6 text-sm text-gray-700">
      <div class="flex items-center space-x-2">
        <button class="px-3 py-1 rounded-lg border border-gray-300 hover:bg-gray-100">Anterior</button>
        <button class="px-3 py-1 rounded-lg bg-blue-500 text-white">2</button>
        <button class="px-3 py-1 rounded-lg border border-gray-300 hover:bg-gray-100">3</button>
        <span class="px-2">...</span>
        <button class="px-3 py-1 rounded-lg border border-gray-300 hover:bg-gray-100">10</button>
        <button class="px-3 py-1 rounded-lg border border-gray-300 hover:bg-gray-100">Próximo</button>
      </div>
      <div class="mt-4 md:mt-0">
        Total de linhas: <span class="font-semibold">100</span>
      </div>
    </div>
  </div>

</template>

<script setup lang="ts">
defineProps<{ title?: string }>();
</script>

<style scoped>

</style>