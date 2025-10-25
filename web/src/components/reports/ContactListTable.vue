<template>
  <div class="min-h-screen">
    <div class="p-6 bg-white rounded-2xl shadow-md">
    <!-- Título -->
    <h2 class="text-2xl font-semibold mb-6">Lista de Contatos</h2>
    <!-- Filtros -->

    <div class="w-full">
      <div class="flex justify-start mb-4">
        <button class="bg-green-500 text-white px-4 py-2 hover:bg-green-600 rounded-full" @click="router.push('/contacts/create')">Adicionar </button>
        
        <div class="flex justify-end w-full">
           <button
            @click="onDownloadReport"  
            class="bg-blue-500 text-white px-4 py-2 hover:bg-blue-600 rounded-full">
            <svg class="w-5 h-5 mr-2 -ml-1 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 0115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"></path></svg>
            Exportar CSV
          </button>

        </div>
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
        <tr v-for="row in store.data" :key="row.id" class="hover:bg-gray-50">
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
            {{ row.created_at ? formatToBR(row.created_at) : '' }}
          </td>
          <td class="px-4 py-3 border-b text-center">
            <PencilIcon @click.stop="handleEdit(row.id!)" class="w-5 h-5 text-blue-500 hover:text-blue-700 inline" />
            <EraserIcon @click="handleDelete(row.id!)" class="w-5 h-5 text-red-500 hover:text-red-700 inline ml-4" />
          </td>
        </tr>
        </tbody>
      </table>
    </div>

    <!-- Paginação -->
    <div class="flex flex-col md:flex-row items-center justify-between mt-6 text-sm text-gray-700">
      <div class="flex items-center space-x-2" v-if="store.current_page">
        <button @click="store.loadContacts(store.current_page - 1)" :disabled="store.current_page === 1" class="px-3 py-1 rounded-lg border border-gray-300 hover:bg-gray-100">Anterior</button>
        <span> Página {{ store.current_page }} de {{ store.last_page }} </span>
        <button @click="store.loadContacts(store.current_page + 1)" :disabled="store.current_page === store.last_page" class="px-3 py-1 rounded-lg border border-gray-300 hover:bg-gray-100">Próximo</button>
      </div>
      <div class="mt-4 md:mt-0">
        Total de linhas: <span class="font-semibold">{{ store.total }}</span>
      </div>
    </div>
  </div>
  </div>
  
</template>

<script setup lang="ts">
  import { onMounted,defineEmits } from 'vue';
  
  import { formatToBR } from '@/utils/date';
  import { PencilIcon, EraserIcon } from 'lucide-vue-next';
  import { formattedPhone } from '@/utils/helpers';
  import router from '@/router';
  import { useContactListStore } from '@/stores/contactListStore';

  const store = useContactListStore();

  onMounted(() => {
      store.loadContacts();
  });

  function handleEdit(rowId: number) {
    router.push({ name: 'ContactEditPage', params: { id: rowId } });
  }

  function handleDelete(rowId: number) {
    store.deleteContactById(rowId);
  }

  function onDownloadReport() {
    store.downloadReport();
  }
  
</script>

<style scoped>

</style>