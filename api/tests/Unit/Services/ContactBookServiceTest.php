<?php

declare(strict_types = 1);

namespace Tests\Unit\Services;

use App\Exceptions\ContactNotFoundException;
use App\Models\ContactBook;
use App\Repositories\ContactBookRepository;
use App\Services\ContactBookService;
use Illuminate\Pagination\LengthAwarePaginator;
use Tests\TestCase;
use \Mockery;

class ContactBookServiceTest extends TestCase
{
    private ContactBookRepository $contactBookRepository;
    private ContactBookService $contactBookService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->contactBookRepository = Mockery::mock(ContactBookRepository::class);
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

    /**
     * @test
     * @return void
     */
    public function it_should_throw_contact_not_found_exception_when_update() : void
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

        $this->contactBookRepository
            ->shouldReceive('update')
            ->once()
            ->with(3, $params)
            ->andReturn(null);

        $this->expectException(ContactNotFoundException::class);

        $this->contactBookService->update(3, $params);
    }

    /**
     * @test
     * @return void
     * @throws ContactNotFoundException
     */
    public function it_delete_contact_with_successfully() : void
    {
        $this->contactBookRepository
            ->shouldReceive('delete')
            ->once()
            ->with(3)
            ->andReturn(true);

        $result = $this->contactBookService->delete(3);

        $this->assertTrue($result);
    }

    /**
     * @test
     * @return void
     */
    public function it_test_paginate_return_contacts(): void
    {
        $contacts = ContactBook::factory()->count(3)->make();

        $paginator = new LengthAwarePaginator($contacts, 3, 10);

        $this->contactBookRepository->shouldReceive('getPaginate')
            ->with()
            ->andReturn($paginator);

        $result = $this->contactBookService->listAllPagination();

        $this->assertInstanceOf(LengthAwarePaginator::class, $result);
        $this->assertCount(3, $result->items());
    }
}
