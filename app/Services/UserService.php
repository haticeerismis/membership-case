<?php

namespace App\Services;

use App\Models\User;
use App\Models\Company;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Interfaces\UserRepositoryInterface;


class UserService
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {

    }

    public function listUsers(array $filters = []): Collection
    {
        return $this->userRepository->getList($filters);
    }


    public function createUser(array $data): User
    {



        if (empty($data['company_name'])) {
            abort(400, 'Firma adı zorunludur');
        }


        $company = Company::firstOrCreate([
            'name' => $data['company_name'],
        ]);


        $userData = [
            'company_id' => $company->id,
            'first_name' => $data['first_name'] ?? null,
            'last_name'  => $data['last_name'] ?? null,
            'email'      => $data['email'] ?? null,
            'phone'      => $data['phone'] ?? null,
        ];

        return $this->userRepository->create($userData);
    }


    public function updateUser(int $id, array $data): User
    {

        $user = $this->userRepository->getById($id);

        if (!$user) {
            abort(404, 'Kullanıcı bulunamadı');
        }


        if (!empty($data['company_name'])) {
            $company = Company::firstOrCreate([
                'name' => $data['company_name'],
            ]);

            $data['company_id'] = $company->id;
        }


        unset($data['company_name']);

        return $this->userRepository->update($user, $data);
    }


    public function deleteUser(int $id): bool
    {
        $user = $this->userRepository->getById($id);

        if (!$user) {
            abort(404, 'Kullanıcı maalesef bulunamadı');
        }

        return $this->userRepository->remove($user);
    }
}
