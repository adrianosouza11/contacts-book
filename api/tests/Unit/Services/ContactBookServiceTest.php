<?php

namespace Tests\Unit\Services;

use App\Models\ContactBook;
use App\Repositories\ContactBookRepository;
use App\Services\ContactBookService;
use Tests\TestCase;
use \Mockery;

class ContactBookServiceTest extends TestCase
{
    private ContactBookRepository $contactBookRepository;
    private ContactBookService $contactBookService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->contactBookRepository = \Mockery::mock(ContactBookRepository::class);
        $this->contactBookService = new ContactBookService($this->contactBookRepository);
    }

    /**
     * @test
     * @return void
     */
    public function it_must_be_store_contact() : void
    {
        $params = [
            'contact_name' => 'Adriano Oliveira',
            'contact_phone' => '31999855214',
            'contact_email' => 'adriano.oliveira@gmail.com',
            'address' => 'Rua Carlos Lacerda',
            'number' => '941',
            'neighborhood' => 'Trevo',
            'city' => 'Belo Horizonte',
            'state' => 'MG',
            'postal_code' => '31545170',
        ];

        $expected = ContactBook::hydrate([
            'id' => 1,
            ...$params
        ])->first();

        $this->contactBookRepository
            ->shouldReceive('create')
            ->once()
            ->with($params)
            ->andReturn($expected);

        $result = $this->contactBookService->store($params);

        $this->assertEquals($expected, $result);
    }
}
