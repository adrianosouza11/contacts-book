<?php

namespace App\Repositories;

use App\Models\ContactBook;

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
}
