<?php

namespace App\Services;

use App\Models\ContactBook;
use App\Repositories\ContactBookRepository;

class ContactBookService
{
    private ContactBookRepository $contactBookRepository;

    public function __construct(ContactBookRepository $contactBookRepository)
    {
        $this->contactBookRepository = $contactBookRepository;
    }

    /**
     * @param array $params
     * @return ContactBook
     */
    public function store(array $params) : ContactBook
    {
        return $this->contactBookRepository->create($params);
    }

    /**
     * @param int $id
     * @param array $params
     * @return ContactBook
     */
    public function update(int $id, array $params) : ContactBook
    {
        return $this->contactBookRepository->update($id, $params);
    }
}
