<template>
  <div class="p-6 bg-white rounded-2xl shadow-md">
    <!-- Título -->
    <h2 class="text-2xl font-semibold mb-6">Lista de Contatos</h2>
    <!-- Filtros -->

    <div class="w-full">
      <div class="flex justify-start mb-4">
        <button class="bg-green-500 text-white px-4 py-2 hover:bg-green-600 rounded-full" @click="router.push('/contacts/create')">Adicionar </button>
      </div>
    </div>

    <!-- Tabela -->
    <div class="overflow-x-auto">
      <table class="min-w-full text-left text-sm border border-gray-200 rounded-lg overflow-hidden">
        <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
        <tr>
          <th key="id" class="px-4 py-3 border-b border-gray-200">
            ID
          </th>
          <th key="contact_name" class="px-4 py-3 border-b border-gray-200">
            Nome
          </th>
          <th key="contact_phone" class="px-4 py-3 border-b border-gray-200 text-center">
            Telefone
          </th>
          <th key="contact_email" class="px-4 py-3 border-b border-gray-200">
            E-mail
          </th>
          <th key="create_at" class="px-4 py-3 border-b border-gray-200 text-center">
            Criado em:
          </th>
          <th class="text-center">
            Ações
          </th>
        </tr>
        </thead>
        <tbody class="text-gray-700">
        <tr v-for="row in data" :key="row.id" class="hover:bg-gray-50">
          <td class="px-4 py-3 border-b">
            {{ row.id }}
          </td>
          <td class="px-4 py-3 border-b">
            {{ row.contact_name }}
          </td>
          <td class="px-4 py-3 border-b text-center">
            {{ formattedPhone(row.contact_phone) }}
          </td>
          <td class="px-4 py-3 border-b">
            {{ row.contact_email }}
          </td>
          <td class="4 py-3 border-b text-center">
            {{ formatToBR(row.created_at) }}
          </td>
          <td class="px-4 py-3 border-b text-center">
            <PencilIcon @click.stop="emit('row-details')" class="w-5 h-5 text-blue-500 hover:text-blue-700 inline" />
          </td>
        </tr>
        </tbody>
      </table>
    </div>

    <!-- Paginação -->
    <div class="flex flex-col md:flex-row items-center justify-between mt-6 text-sm text-gray-700">
      <div class="flex items-center space-x-2" v-if="meta.current_page">
        <button @click="fetchData(meta.current_page - 1)" :disabled="meta.current_page === 1" class="px-3 py-1 rounded-lg border border-gray-300 hover:bg-gray-100">Anterior</button>
        <span> Página {{ meta.current_page }} de {{ meta.last_page }} </span>
        <button @click="fetchData(meta.current_page + 1)" :disabled="meta.current_page === meta.last_page" class="px-3 py-1 rounded-lg border border-gray-300 hover:bg-gray-100">Próximo</button>
      </div>
      <div class="mt-4 md:mt-0">
        Total de linhas: <span class="font-semibold">{{ meta.total }}</span>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
  import { onMounted,defineEmits } from 'vue';
  import { useReportData } from '@/composables/useReportData';
  import { formatToBR } from '@/utils/date';
  import { PencilIcon, PlusIcon } from 'lucide-vue-next';
  import { formattedPhone } from '@/utils/helpers';
import router from '@/router';

  const { data, meta, fetchData } = useReportData('http://localhost:8000/api/contacts');

  onMounted( () => {
      fetchData();
  });

  const emit = defineEmits(['row-details']);
</script>

<style scoped>

</style>