<?php

namespace NucleusOffice\People\Services;

use Illuminate\Support\Facades\DB;
use NucleusOffice\Foundation\Services\Service;
use NucleusOffice\People\Contracts\User as UserRepoContract;

class UserService extends Service
{
    function __construct(UserRepoContract $repo)
    {
        parent::__construct($repo);
    }

    public function make(array $data)
    {
        DB::beginTransaction();

        $user = $this->repo->make($data)->toModel();

        if (isset($data['roles']))
            $user->roles()->sync($data['roles']);

        DB::commit();

        if (isset($data['must_verify_email']))
            $user->sendEmailVerificationNotification();

        return $user->load('roles');
    }

    public function get($id)
    {
        return $this->repo->get($id)->toModel()->load(['roles.permissions']);
    }

    public function update($id, array $data)
    {
        DB::beginTransaction();

        $user = $this->repo->get($id)->update($data)->toModel();

        if (isset($data['roles']))
            $user->roles()->sync($data['roles']);

        DB::commit();

        return $user->load('roles');
    }

    public function delete($id)
    {
        return $this->repo->delete($id);
    }
}
