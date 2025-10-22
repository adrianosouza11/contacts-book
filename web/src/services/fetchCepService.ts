import axios from "axios";

export interface HttpFetchCepResponse {
    cep: string;
    logradouro: string;
    localidade: string;
    uf: string;
    bairro: string;
}

export function fetchCep(cep: string) {
    const cleanedCep = cep.replace(/\D/g, '');

    return axios.get<HttpFetchCepResponse>(`https://viacep.com.br/ws/${cleanedCep}/json/`);
}