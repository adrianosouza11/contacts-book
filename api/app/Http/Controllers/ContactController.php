<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\GenerateCsvContactsAction;
use App\Exceptions\ContactNotFoundException;
use App\Exceptions\ContentPathNotFoundException;
use App\Jobs\SendBackEmailsJob;
use App\Repositories\ContactBookRepository;
use App\Services\ContactBookExportService;
use App\Services\ContactBookService;
use App\Http\Requests\ContactBook\PostContactRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ContactController extends Controller
{
    private ContactBookService $contactBookService;
    private ContactBookExportService $contactBookExportService;

    public function __construct()
    {
        $this->contactBookService = new ContactBookService(new ContactBookRepository());

        $this->contactBookExportService = new ContactBookExportService(
            $this->contactBookService,
            new GenerateCsvContactsAction()
        );
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $list = $this->contactBookService->listAllPagination();

        return response()->json($list);
    }

    /**
     * @param PostContactRequest $request
     * @return JsonResponse
     */
    public function store(PostContactRequest $request) : JsonResponse
    {
        $stored = $this->contactBookService->store($request->validated());

        SendBackEmailsJob::dispatch($stored)->onQueue('back_emails');

        return response()->json([
            "status" => 'CREATED',
            'data' => $stored
        ],201);
    }

    /**
     * @param int $id
     * @param PostContactRequest $request
     * @return JsonResponse
     * @throws ContactNotFoundException
     */
    public function update(int $id, PostContactRequest $request) : JsonResponse
    {
        $updated = $this->contactBookService->update($id, $request->validated());

        return response()->json([
            'status' => 'UPDATED',
            'data' => $updated
        ]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     * @throws ContactNotFoundException
     */
    public function destroy(int $id) : JsonResponse
    {
        $deleted = $this->contactBookService->delete($id);

        return response()->json([
            'status' => 'DELETED',
            'data' => $deleted
        ]);
    }

    /**
     * @return BinaryFileResponse
     * @throws ContentPathNotFoundException
     */
    public function exportCsv() : BinaryFileResponse
    {
        $filename = $this->contactBookExportService->exportCsv();

        return $this->contactBookExportService->download($filename, [
            'Content-Type' => 'text/csv',
        ]);
    }
}
