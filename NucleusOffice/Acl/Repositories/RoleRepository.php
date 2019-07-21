<?php

namespace NucleusOffice\Acl\Repositories;

use NucleusOffice\Acl\Contracts\Role as RepositoryInterface;
use NucleusOffice\Acl\Entities\Role;
use NucleusOffice\Foundation\Repositories\Repository;

class RoleRepository extends Repository implements RepositoryInterface
{
    function __construct(Role $model)
    {
        parent::__construct($model);
    }
}
