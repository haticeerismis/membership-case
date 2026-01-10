<?php

namespace App\Http\Controllers;

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


    public function store(Request $request)
    {
        $data = $request->validate([
            'company_name' => 'required|string',
            'first_name'   => 'required|string',
            'last_name'    => 'required|string',
            'email'        => 'required|email',
            'phone'        => 'required|string',
        ]);

        $user = $this->userService->createUser($data);

        return response()->json([
            'success' => true,
            'message' => 'Kullanıcı oluşturuldu',
            'data'    => $user,
        ], 201);
    }


    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'company_name' => 'sometimes|string',
            'first_name'   => 'sometimes|string',
            'last_name'    => 'sometimes|string',
            'email'        => 'sometimes|email',
            'phone'        => 'sometimes|string',
        ]);

        $user = $this->userService->updateUser($id, $data);

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
