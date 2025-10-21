<?php

namespace Tests\Unit\Services;

use App\Actions\GenerateCsvContactsAction;
use App\Exceptions\ContentPathNotFoundException;
use App\Models\ContactBook;
use App\Services\ContactBookExportService;
use App\Services\ContactBookService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

use Tests\TestCase;

use \Mockery;

class ContactBookExportServiceTest extends TestCase
{
    private ContactBookExportService $contactBookExportService;

    private ContactBookService $contactBookService;
    private GenerateCsvContactsAction $generateCsvContactsAction;

    public function setUp(): void
    {
        parent::setUp();

        $this->contactBookService = Mockery::mock(ContactBookService::class);
        $this->generateCsvContactsAction = Mockery::mock(GenerateCsvContactsAction::class);

        $this->contactBookExportService = new ContactBookExportService(
            $this->contactBookService,
            $this->generateCsvContactsAction
        );
    }

    /**
     * @test
     * @return void
     */
    public function it_should_return_filename_exported_csv() : void
    {
        $contacts = ContactBook::factory()->count(10)->make();

         $expectedPagination = new LengthAwarePaginator($contacts, $contacts->count(), 10);

        $this->contactBookService
            ->shouldReceive('listAllPagination')
            ->once()
            ->andReturn($expectedPagination);

        $this->generateCsvContactsAction->shouldReceive('generate')
            ->once()
            ->andReturn();

        $resultFileName = $this->contactBookExportService->exportCsv();

       $this->assertStringContainsString('.csv', $resultFileName);
    }

    /**
     * @test
     * @return void
     * @throws ContentPathNotFoundException
     */
    public function should_return_binary_file_response() : void
    {
        $filename = 'contacts-2025-10-10.csv';

        Storage::fake('public');

        Storage::disk('public')->put($filename, 'ID,Nome,Telefone,E-mail,Endereço,Número,Bairro,Cidade,Estado,CEP,Criado em:
6,Bartholome Barrows,87371403078,jonas.wuckert@example.org,3495 Bernadine Lock Suite 457,95586,aut,West Ethanstad,MI,28211262,2025-10-21 20:16:19
1');
        $result = $this->contactBookExportService->download($filename);

        $this->assertInstanceOf(BinaryFileResponse::class, $result);
    }
}
