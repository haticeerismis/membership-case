<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\StoreUserRequest;


use Illuminate\Http\Request;
use App\Services\UserService;

class UserController extends Controller
{
    //

    public function __construct(
        private UserService $userService
    ) {

    }


    public function index(Request $request)
    {
        $filters = $request->only([
            'company_id',
            'email',
        ]);

        $users = $this->userService->listUsers($filters);

        return response()->json([
            'success' => true,
            'data' => $users,
        ]);
    }


    public function store(StoreUserRequest $request)
    {
        $user = $this->userService->createUser(
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Kullanıcı oluşturuldu',
            'data'    => $user,
        ], 201);
    }


    public function update(UpdateUserRequest $request, int $id)
    {
        $user = $this->userService->updateUser(
            $id,
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Kullanıcı güncellendi',
            'data'    => $user,
        ]);
    }


    public function destroy(int $id)
    {
        $this->userService->deleteUser($id);

        return response()->json([
            'success' => true,
            'message' => 'Kullanıcı silindi',
        ]);
    }
}
