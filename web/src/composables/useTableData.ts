import { ref } from 'vue';
import { useLoading } from '@/composables/useLoading';
import { fetchListContacts, type ContactType, type HttpPaginationResponse } from '@/services/contactService';

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

  return {
    pagination,
    fetchData,
  }
}