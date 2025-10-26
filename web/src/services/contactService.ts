import axios from "axios";

export interface HttpPaginationResponse {
  current_page: number;
  last_page: number;
  per_page: number;
  total: number;
  links: Array<{ url: string | null; label: string; active: boolean }>;
  data: Array<ContactType>;
}

export interface ContactType {
    id?: number;
    contact_name: string;
    contact_phone: string;
    contact_email: string;
    address: string;
    number: string;
    neighborhood: string;
    city: string;
    state: string;
    postal_code: string;
    created_at?: string;
    updated_at?: string;
}

export interface HttpResponseContactStored {
  status: number
  data: Array<ContactType>
}

const apiUrl = import.meta.env.VITE_API_URL || 'http://localhost:8000/api';

export async function storeContact(form: ContactType) {
  return axios.post<HttpResponseContactStored>(apiUrl + '/contacts',form,{
    headers: {
      Accept: 'application/json',
      'Content-Type': 'application/json'
    }
  });
}

export function fetchListContacts(page: number = 1) {
  const params = new URLSearchParams({ page: page.toString() }).toString();

  return axios.get<HttpPaginationResponse>(apiUrl + `/contacts?${params}`,{
    headers: {
      Accept: 'application/json',
      'Content-Type': 'application/json'
    }
  });
}

export function fetchContactById(id: number) 
{
  return axios.get<{ status: String, data: ContactType }>(apiUrl + `/contacts/${id}`,{
    headers: {
      Accept: 'application/json',
      'Content-Type': 'application/json'
    }
  });
}

export async function updateContact(form: ContactType) {
  return axios.put<HttpResponseContactStored>(apiUrl + '/contacts/' + form.id,form,{
    headers: {
      Accept: 'application/json',
      'Content-Type': 'application/json'
    }
  });
}

export async function deleteContact(id: number) {
  return axios.delete<{ status: string, data: boolean }>(apiUrl + '/contacts/' + id,{
    headers: {
      Accept: 'application/json',
      'Content-Type': 'application/json'
    }
  });
}

export async function downloadContactsReport() {
  return axios.get(apiUrl + '/contacts/export/csv', {
    responseType: 'arraybuffer',
    headers: {
      Accept: 'text/csv',
      'Content-Type': 'application/json'
    }
  })
}
