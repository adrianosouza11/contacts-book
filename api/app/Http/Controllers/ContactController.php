<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Repositories\ContactBookRepository;
use App\Services\ContactBookService;
use App\Http\Requests\ContactBook\PostContactRequest;
use Illuminate\Http\JsonResponse;

class ContactController extends Controller
{
    private ContactBookService $contactBookService;

    public function __construct()
    {
        $this->contactBookService = new ContactBookService(new ContactBookRepository());
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
}
