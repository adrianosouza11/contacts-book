<?php

namespace App\Services;

use App\Exceptions\ContactNotFoundException;
use App\Models\ContactBook;
use App\Repositories\ContactBookRepository;
use Illuminate\Pagination\LengthAwarePaginator;

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
     * @return ContactBook|null
     * @throws ContactNotFoundException
     */
    public function update(int $id, array $params) : ?ContactBook
    {
        $updated = $this->contactBookRepository->update($id, $params);

        if(!$updated)
            throw new ContactNotFoundException("Not found contact to update");

        return $updated;
    }

    /**
     * @param int $id
     * @return bool
     * @throws ContactNotFoundException
     */
    public function delete(int $id) : bool
    {
        $deleted = $this->contactBookRepository->delete($id);

        if(!$deleted)
            throw new ContactNotFoundException("Not found contact to update");

        return $deleted;
    }

    /**
     * @return LengthAwarePaginator
     */
    public function listAllPagination() : LengthAwarePaginator
    {
        return $this->contactBookRepository->getPaginate();
    }
}
