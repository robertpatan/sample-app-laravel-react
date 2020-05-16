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
    public function create($modelData)
    {
        return $this->model->create($modelData);
    }
    
}
