<?php

namespace NucleusOffice\Foundation\Repositories;

use Illuminate\Database\Eloquent\Model;
use NucleusOffice\Foundation\Contracts\Repository as RepositoryInterface;

abstract class Repository implements RepositoryInterface
{
    protected $model;

    protected $primaryKey;

    function __construct(Model $model, $primaryKey = 'id')
    {
        $this->model = $model;
        $this->primaryKey = $primaryKey;
    }

    public function make(array $data): RepositoryInterface
    {
        $this->model->fill($data);

        $this->model->save();

        return $this;
    }

    public function update(array $data): RepositoryInterface
    {
        $this->model->update($data);

        return $this;
    }

    public function get($id): RepositoryInterface
    {
        if (in_array('Dyrynda\Database\Support\GeneratesUuid', class_uses($this->model))) {
            $modelFound = $this->model->whereUuid($id)->first();
        } else {
            $modelFound = $this->model->where($this->primaryKey, $id)->first();
        }

        if (! $modelFound)
            abort(404, 'Resource Not Found');

        $this->model = $modelFound;

        return $this;
    }

    public function delete($id, $force = false)
    {
        $this->get($id);

        if ($force)
            $this->model->forceDelete();
        else
            $this->model->delete();

        return true;
    }

    public function setPrimaryKey($primaryKey): RepositoryInterface
    {
        $this->primaryKey = $primaryKey;

        return $this;
    }

    public function toModel() : Model
    {
        return $this->model;
    }

    public function toArray(): array
    {
        return $this->model->toArray();
    }
}
