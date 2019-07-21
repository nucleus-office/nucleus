<?php

namespace NucleusOffice\People\Repositories;

use NucleusOffice\Foundation\Repositories\Repository;
use NucleusOffice\People\Contracts\User as UserRepoContract;
use NucleusOffice\People\Entities\User;

class UserRepository extends Repository implements UserRepoContract
{
    function __construct(User $model)
    {
        parent::__construct($model);
    }
}
