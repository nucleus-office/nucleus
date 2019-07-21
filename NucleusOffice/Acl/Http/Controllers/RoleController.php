<?php

namespace NucleusOffice\Acl\Http\Controllers;

use NucleusOffice\Acl\Entities\Role;
use NucleusOffice\Acl\Http\Requests\RoleRequest;
use NucleusOffice\Acl\Services\RoleService;
use Nwidart\Modules\Routing\Controller;

class RoleController extends Controller
{
    protected $roleService;

    function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function index()
    {
        $this->authorize('index', Role::class);

        return response()->json(Role::withoutTrashed()->with('permissions')->jsonPaginate(), 200); // Needs pagination
    }

    public function store(RoleRequest $request)
    {
        $this->authorize('create', Role::class);

        $role = $this->roleService->make($request->all());

        return response()->json($role->toArray(), 201);
    }

    public function show($role)
    {
        $role = $this->roleService->get($role);

        $this->authorize('view',  $role);

        return response()->json($role->toArray(), 200);
    }

    public function update(RoleRequest $request, $role)
    {
        $this->authorize('update', $this->roleService->get($role));

        $role = $this->roleService->update($role, $request->all());

        return response()->json($role, 200);
    }

    public function destroy($role)
    {
        $this->authorize('delete', $this->roleService->get($role));

        $this->roleService->delete($role);

        return response()->json(['message' => 'The role has been deleted'], 204);
    }
}
