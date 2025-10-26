import { ref } from 'vue';
import { useLoading } from '@/composables/useLoading';
import { deleteContact, fetchListContacts, type ContactType, type HttpPaginationResponse, downloadContactsReport, fetchContactById } from '@/services/contactService';
import { useNotification } from '@/composables/useNotification';
import { useI18n } from 'vue-i18n';
import { useLanguageStore } from '@/stores/languageStore';

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

  const { t } = useI18n();
  const languageStore = useLanguageStore();
  languageStore.loadLanguage();

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

      fetchData(pagination.value.current_page);

      toastSuccess(t('contactListPage.toastDeletedSuccessful'));
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
      toastError(t('app.toastInternalError'));
    } finally { 
      loadingStop();
    }
  }

  /**
   * @param id 
   * @returns Promise<ContactType|null>
   */
  async function findContactById(id: number) : Promise<ContactType|null> 
  {
    loadingStart();

    try {
      return (await fetchContactById(id)).data.data;
    } catch (error) {
      toastError(t('app.toastInternalError'));
    } finally { 
      loadingStop();
    }
    
    return null;
  }

  return {
    pagination,
    fetchData,
    deleteContactById,
    downloadReport,
    findContactById
  }
}