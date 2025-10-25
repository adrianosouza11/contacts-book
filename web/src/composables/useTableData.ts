import { ref } from 'vue';
import { useLoading } from '@/composables/useLoading';
import { deleteContact, fetchListContacts, type ContactType, type HttpPaginationResponse, downloadContactsReport } from '@/services/contactService';
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

  async function downloadReport() {
    loadingStart();

    try {
      const res = await downloadContactsReport();

      const url = window.URL.createObjectURL(new Blob([res.data]));
      const link = document.createElement('a');

      link.href = url;
      link.setAttribute('download', 'report.csv');
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
      window.URL.revokeObjectURL(url);
    } catch (error) {
      toastError('Ocorreu um erro ao tentar fazer download.');
    } finally { 
      loadingStop();
    }
  }

  return {
    pagination,
    fetchData,
    deleteContactById,
    downloadReport
  }
}