<?php

namespace App\Repositories;

abstract class EloquentRepository
{
    protected $model;

    public function __construct()
    {
        $this->setModel();
    }

    abstract public function getModel();

    public function setModel(){
        $this->model = app()->make(
            $this->getModel()
        );
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        $result = $this->model->find($id);

        return $result;
    }

    public function create(array $attributes)
    {

        return $this->model->create($attributes);
    }

    public function update($id, array $attributes)
    {
        $result = $this->find($id);
        if ($result)
        {
            $result->update($attributes);
            return $result;
        }

        return false;
    }

    public function delete($id)
    {
        $result = $this->find($id);

        if ($result)
        {
            $result->delete();
            return true;
        }

        return false;
    }
}
