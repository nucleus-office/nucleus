<?php

namespace NucleusOffice\People\Traits;

use NucleusOffice\People\Scopes\TenancyScope;

trait HasTenancy
{
    protected static function bootHasTenancy()
    {
        if (auth()->check()) {
            static::addGlobalScope(new TenancyScope());

            static::creating(function ($model) {
                $model->tenancy_id = auth()->user()->current_tenancy_id;
            });
        }
    }
}
