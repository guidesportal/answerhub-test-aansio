<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\ReadableResource;
use App\Repositories\UserRepositoryInterface;

readonly class UserController
{
    use ReadableResource;
    public function __construct(
        private UserRepositoryInterface $repository,
    ) {

    }
}
