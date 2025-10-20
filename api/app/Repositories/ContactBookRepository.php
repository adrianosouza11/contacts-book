<?php

namespace App\Repositories;

use App\Models\ContactBook;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class ContactBookRepository
{
    /**
     * @param array $params
     * @return ContactBook
     */
    public function create(array $params) : ContactBook
    {
        return ContactBook::create($params);
    }

   /**
   * @param int $id
   * @return ContactBook|null
   */
   public function findByPk(int $id) : ?ContactBook
   {
       return ContactBook::find($id);
   }

    /**
     * @param int $id
     * @param array $params
     * @return ContactBook|null
     */
   public function update(int $id, array $params) : ?ContactBook
   {
       $data = $this->findByPk($id);

       if(!$data)
           return null;

       $data->fill($params);
       $data->save();

       return $data;
   }

    /**
     * @param int $id
     * @return bool|null
     */
   public function delete(int $id) : ?bool
   {
       $data = $this->findByPk($id);

       return $data?->delete();
   }

    /**
     * @param int $perPage
     * @return LengthAwarePaginator
     */
   public function getPaginate(int $perPage = 10) : LengthAwarePaginator
   {
       return ContactBook::orderBy('contact_name')->paginate($perPage);
   }
}
