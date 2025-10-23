<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressSearch\GetSearchPostalCodeRequest;
use App\Services\Gateways\ViaCepGatewayService;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\JsonResponse;

class AddressSearchController extends Controller
{
    private ViaCepGatewayService $viaCepGatewayService;

    public function __construct()
    {
        $this->viaCepGatewayService = new ViaCepGatewayService();
    }

    /**
     * @param GetSearchPostalCodeRequest $request
     * @return JsonResponse
     * @throws RequestException
     */
    public function searchAddressByPostalCode(GetSearchPostalCodeRequest $request) : JsonResponse
    {
        $address = $this->viaCepGatewayService->getCepByJson($request->postal_code);

        return response()->json([
            'status' => 'GET_SUCCESS',
            'data' =>  (array) $address
        ]);
    }
}
