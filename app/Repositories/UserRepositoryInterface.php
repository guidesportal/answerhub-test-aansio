<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    public function find(int $id): ?User;
    public function findByEmail(string $email): ?User;

    /**
     * @return Collection<User>
     */
    public function list(?array $with = []): Collection;

}
