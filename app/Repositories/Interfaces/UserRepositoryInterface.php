<?php

namespace App\Repositories\Interfaces;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{

    public function getList(array $filters = []): Collection;

    public function getById(int $id): ?User;

    public function create(array $data): User;

    public function update(User $user, array $data): User;

    public function remove(User $user): bool;
}
