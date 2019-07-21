<?php

namespace NucleusOffice\People\Scopes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class TenancyScope
 *
 * @package \NucleusOffice\People\Scopes
 */
class TenancyScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->where('tenancy_id', '=', auth()->user()->current_tenancy_id);
    }
}
