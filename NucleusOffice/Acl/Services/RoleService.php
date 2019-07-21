<?php

namespace NucleusOffice\Acl\Services;

use Illuminate\Support\Facades\DB;
use NucleusOffice\Acl\Contracts\Role as RoleRepoContract;
use NucleusOffice\Foundation\Services\Service;

class RoleService extends Service
{
    function __construct(RoleRepoContract $repo)
    {
        parent::__construct($repo);

        $repo->setPrimaryKey('id');
    }

    public function make(array $data)
    {
        $role = DB::transaction(function () use ($data) {
            $role = $this->repo->make($data)->toModel();

            $role->permissions()->sync($data['permissions']);

            return $role;
        });

        return $role->load('permissions');
    }

    public function get($id)
    {
        return $this->repo->get($id)->toModel()->load('permissions');
    }

    public function update($id, array $data)
    {
        $role = DB::transaction(function () use ($id, $data) {
            $role = $this->repo->get($id)->update($data)->toModel();

            if (isset($data['permissions']))
                $role->permissions()->sync($data['permissions']);

            return $role;
        });

        return $role->load('permissions');
    }

    public function delete($id)
    {
        return $this->repo->delete($id);
    }
}
