<?php

namespace NucleusOffice\People\Http\Controllers;

use Illuminate\Routing\Controller;
use NucleusOffice\People\Entities\User;
use NucleusOffice\People\Http\Requests\UserRequest;
use NucleusOffice\People\Services\UserService;

class UserController extends Controller
{
    protected $userService;

    function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        return response()->json(User::jsonPaginate(), 200);
    }

    public function store(UserRequest $request)
    {
        $user = $this->userService->make($request->all());

        return response()->json($user->toArray(), 201);
    }

    public function show($id)
    {
        $user = $this->userService->get($id);

        return response()->json($user->toArray(), 200);
    }

    public function update(UserRequest $request, $id)
    {
        $user = $this->userService->update($id, $request->all());

        return response()->json($user->toArray(), 200);
    }

    public function destroy($id)
    {
        $this->userService->delete($id);

        return response()->json(['message' => 'The user has been deleted'], 204);
    }
}
