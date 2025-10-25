import { defineStore } from 'pinia';
import { type HttpPaginationResponse, type ContactType } from '@/services/contactService';
import { useTableData } from '@/composables/useTableData';

const { fetchData, pagination, deleteContactById } = useTableData();

export const useContactListStore = defineStore('contact-list', {
  state: () => <HttpPaginationResponse> ({
    current_page: 1,
    last_page: 0,
    per_page: 0,
    total: 0,
    links: [],
    data: []
  }),
  getters: {
    getContactById(state) {
        return (id: number): ContactType | undefined => state.data.find(contact => contact.id === id);
    }
  },
  actions: {
    async loadContacts(page: number = 1) {
      const pagination = await this.fetchFromApi(page);

      this.current_page = pagination.current_page;
      this.last_page = pagination.last_page;
      this.per_page = pagination.per_page;
      this.total = pagination.total;
      this.links = pagination.links;
      this.data = pagination.data;
    },

    async fetchFromApi(page: number = 1) {
      await fetchData(page);

      return { ...pagination.value }
    },

    async deleteContactById(id: number) {
      await deleteContactById(id);

      this.loadContacts(this.current_page);
    }
  }
});