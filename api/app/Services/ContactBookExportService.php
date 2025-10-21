<?php

namespace App\Services;

use App\Actions\GenerateCsvContactsAction;
use App\Exceptions\ContentPathNotFoundException;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ContactBookExportService
{
    private ContactBookService $contactBookService;
    private GenerateCsvContactsAction $generateCsvContactsAction;

    public function __construct(ContactBookService $contactBookService, GenerateCsvContactsAction $generateCsvContactsAction)
    {
        $this->contactBookService = $contactBookService;

        $this->generateCsvContactsAction = $generateCsvContactsAction;
    }

    /**
     * @return string
     */
    public function exportCsv() : string
    {
        $filename = 'contacts-' . date('Y-m-d') . '.csv';

        $data = $this->contactBookService->listAllPagination()->collect();

        $folder = Config::get('filesystems.disks.public');

        $path = $folder['root'] .  "/" . $filename;

        $this->generateCsvContactsAction->generate($data, $path);

        return $filename;
    }

    /**
     * @param string $filename
     * @param array $headers
     * @return BinaryFileResponse
     * @throws ContentPathNotFoundException
     */
    public function download(string $filename, array $headers = []): BinaryFileResponse
    {
        $storageDiskPublic = Storage::disk('public');

        $path = $storageDiskPublic->path($filename);

        if(!$storageDiskPublic->exists($filename))
            throw new ContentPathNotFoundException();

        return response()->download($path,$filename, $headers);
    }
}
