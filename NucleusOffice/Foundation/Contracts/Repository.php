<?php

namespace NucleusOffice\Foundation\Contracts;

use Illuminate\Database\Eloquent\Model;

interface Repository
{
    public function make(array $data) : Repository;

    public function update(array $data) : Repository;

    public function get($id) : Repository;

    public function delete($id, $force = false);

    public function setPrimaryKey($primaryKey);

    public function toModel() : Model;

    public function toArray() : array;
}
