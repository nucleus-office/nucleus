<?php

namespace NucleusOffice\Acl\Entities;

use Illuminate\Database\Eloquent\SoftDeletes;
use NucleusOffice\People\Traits\HasTenancy;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use SoftDeletes, HasTenancy;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'description', 'type', 'guard_name', 'tenancy_id'
    ];

    protected $hidden = ['guard_name'];
}
