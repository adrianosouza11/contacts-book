<?php

namespace App\Services\Gateways;

use App\DTO\SearchAddressDTO;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

class ViaCepGatewayService
{
    private string $baseUrl;

    public function __construct()
    {
        $this->baseURL = env('VIA_CEP_API_URL', 'https://viacep.com.br');
    }

    /**
     * @param string $cep
     * @return SearchAddressDTO
     * @throws RequestException
     */
    public function getCepByJson(string $cep) : SearchAddressDTO
    {
        $res = Http::get($this->baseURL . "/ws/$cep/json");

        $res->throw();

        $data = $res->json();

        return new SearchAddressDTO(
            street: $data['logradouro'],
            number: '',
            neighborhood: $data['bairro'],
            zipCode: $data['cep'],
            city: $data['localidade'],
            country: 'BR',
            state: $data['uf']
        );
    }
}
