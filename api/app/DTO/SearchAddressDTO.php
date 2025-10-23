<?php

namespace App\DTO;

class SearchAddressDTO
{
    public function __construct(
        public readonly string $street,
        public readonly string $number,
        public readonly string $neighborhood,
        public readonly string $zipCode,
        public readonly string $city,
        public readonly string $country,
        public readonly string $state
    ) {}
}
