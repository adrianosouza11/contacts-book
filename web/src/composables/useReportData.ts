import { ref, watch } from 'vue';
import axios from 'axios';
import { useLoading } from '@/composables/useLoading'

interface ContactDataType {
  id: number;
  contact_name: string;
  contact_phone: string;
  contact_email: string;
  address: string
  created_at: string;
}

interface MetadataType {
  current_page: number;
  last_page: number;
  per_page: number;
  total: number;
} 

export function useReportData(endpoint: string) {
  const data = ref<Array<ContactDataType>>([]);
  const meta = ref<MetadataType>({
    current_page: 1,
    last_page: 0,
    per_page: 0,
    total: 0
  });

  const {  loadingStart, loadingStop  } = useLoading();

  async function fetchData(page: number = 1) {
    loadingStart();

    const params = new URLSearchParams({ page: page.toString() }).toString();
    const response = await axios.get(`${endpoint}?${params}`, {
      headers: {
        Accept: 'application/json'
      }
    });


    data.value = response.data.data;
    meta.value = response.data;

    loadingStop();
  }

  return {
    data,
    meta,
    fetchData,
  }
}