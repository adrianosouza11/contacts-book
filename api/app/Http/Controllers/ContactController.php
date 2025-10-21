<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Exceptions\ContactNotFoundException;
use App\Repositories\ContactBookRepository;
use App\Services\ContactBookService;
use App\Http\Requests\ContactBook\PostContactRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    private ContactBookService $contactBookService;

    public function __construct()
    {
        $this->contactBookService = new ContactBookService(new ContactBookRepository());
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $list = $this->contactBookService->listAllPagination($request->all());

        return response()->json($list);
    }

    /**
     * @param PostContactRequest $request
     * @return JsonResponse
     */
    public function store(PostContactRequest $request) : JsonResponse
    {
        $stored = $this->contactBookService->store($request->validated());

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
}
