import axios from "axios";

export interface AddressSearchResult {
    cep: string;
    street: string;
    city: string;
    state: string;
    neighborhood: string;
}


export interface HttpFetchCepSuccessResponse {
  status: number
  data: AddressSearchResult
}

const apiUrl = import.meta.env.VITE_API_URL || 'http://localhost:8000/api';

export function fetchCep(postalCode: string) {
    const cleanedCep = postalCode.replace(/\D/g, '');

    return axios.get<HttpFetchCepSuccessResponse>( apiUrl + `/address-search/${cleanedCep}`);
}