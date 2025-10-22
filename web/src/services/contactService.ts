import axios from "axios";

interface ContactType {
    contact_name: string;
    contact_phone: string;
    contact_email: string;
    address: string;
    number: string;
    neighborhood: string;
    city: string;
    state: string;
    postal_code: string;
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