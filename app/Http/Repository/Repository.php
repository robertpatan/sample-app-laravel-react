<?php declare(strict_types=1);


namespace App\Http\Repository;


class Repository
{
    protected object $model;
    
    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->model->get();
    }
    
    public function findById($id)
    {
        return $this->model->find($id);
    }
    
    /**
     * @param $modelData
     * @return mixed
     */
    public function create(array $modelData)
    {
        return $this->model->create($modelData);
    }
    
}
