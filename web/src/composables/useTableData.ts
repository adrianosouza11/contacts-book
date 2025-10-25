import { ref } from 'vue';
import { useLoading } from '@/composables/useLoading';
import { deleteContact, fetchListContacts, type ContactType, type HttpPaginationResponse } from '@/services/contactService';
import { useNotification } from '@/composables/useNotification';

export function useTableData() {
  const pagination = ref<HttpPaginationResponse>({
    current_page: 1,
    last_page: 0,
    per_page: 0,
    total: 0,
    links: [],
    data: []
  });

  const {  loadingStart, loadingStop  } = useLoading();
  const { toastSuccess, toastError } = useNotification();

  async function fetchData(page: number = 1) {
    loadingStart();

    try {
      const res = await fetchListContacts(page);

      pagination.value = res.data;
    } catch (error) {
      console.error('Error fetching table data:', error);
    } finally { 
      loadingStop();
    }
  }

  async function deleteContactById(id: number) {
    loadingStart();

    try {
      await deleteContact(id);

      toastSuccess('Contato apagado com sucesso.');
    } catch (error) {
      toastError('Ocorreu um erro ao tentar apagar contato.');
    } finally { 
      loadingStop();
    }
  }

  return {
    pagination,
    fetchData,
    deleteContactById
  }
}