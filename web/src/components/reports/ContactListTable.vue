<template>
  <div class="min-h-screen">
    <div class="p-6 bg-white rounded-2xl shadow-md">
    <!-- Título -->
    <h2 class="text-2xl font-semibold mb-6">{{ t('contactListPage.title') }}</h2>
    <!-- Filtros -->

    <div class="w-full">
      <div class="flex justify-start mb-4">
        <button class="bg-green-500 text-white px-4 py-2 hover:bg-green-600 rounded-full" @click="router.push('/contacts/create')">{{ t('contactListPage.addButton') }} </button>
        
        <div class="flex justify-end w-full">
           <button
            @click="onDownloadReport"  
            class="bg-blue-500 text-white px-4 py-2 hover:bg-blue-600 rounded-full">
            <svg class="w-5 h-5 mr-2 -ml-1 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 0115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"></path></svg>
            {{ t('contactListPage.exportButton') }}
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
            {{ t('contactListPage.table.thead.contact_name') }}
          </th>
          <th key="contact_phone" class="px-4 py-3 border-b border-gray-200 text-center">
            {{ t('contactListPage.table.thead.contact_phone') }}
          </th>
          <th key="contact_email" class="px-4 py-3 border-b border-gray-200">
            {{ t('contactListPage.table.thead.contact_email') }}
          </th>
          <th key="create_at" class="px-4 py-3 border-b border-gray-200 text-center">
            {{ t('contactListPage.table.thead.created_at') }}
          </th>
          <th class="text-center">
            {{ t('contactListPage.table.thead.actions') }}
          </th>
        </tr>
        </thead>
        <tbody class="text-gray-700">
        <tr v-for="row in pagination.data" :key="row.id" class="hover:bg-gray-50">
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
      <div class="flex items-center space-x-2" v-if="pagination.current_page">
        <button @click="fetchData(pagination.current_page - 1)" :disabled="pagination.current_page === 1" class="px-3 py-1 rounded-lg border border-gray-300 hover:bg-gray-100">{{ t('contactListPage.pagination.previous') }}</button>
        <span>
          {{ t('contactListPage.pagination.pageInfo', { current: pagination.current_page, total: pagination.last_page }) }} 
         </span>
        <button @click="fetchData(pagination.current_page + 1)" :disabled="pagination.current_page === pagination.last_page" class="px-3 py-1 rounded-lg border border-gray-300 hover:bg-gray-100">
          {{ t('contactListPage.pagination.next') }}
        </button>
      </div>
      <div class="mt-4 md:mt-0">
        {{ t('contactListPage.pagination.linesTotal') }} <span class="font-semibold">{{ pagination.total }}</span>
      </div>
    </div>
  </div>
  </div>
  
</template>

<script setup lang="ts">
import { onMounted } from 'vue';

import { formatToBR } from '@/utils/date';
import { PencilIcon, EraserIcon } from 'lucide-vue-next';
import { formattedPhone } from '@/utils/helpers';
import router from '@/router';
import { useI18n } from 'vue-i18n';
import { useTableData } from '@/composables/useTableData';
import { useLanguageStore } from '@/stores/languageStore';

  const { 
    pagination,
    fetchData, 
    deleteContactById,
    downloadReport 
  } =  useTableData();

  onMounted(() => {
      fetchData();
  });

  function handleEdit(rowId: number) {
    router.push({ name: 'ContactEditPage', params: { id: rowId } });
  }

  function handleDelete(rowId: number) {
    deleteContactById(rowId);
  }

  function onDownloadReport() {
    downloadReport();
  }

  const { t } = useI18n();
  const languageStore = useLanguageStore();
  languageStore.loadLanguage();
  
</script>

<style scoped>

</style>