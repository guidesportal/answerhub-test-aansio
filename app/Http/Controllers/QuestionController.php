<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\ReadableResource;
use App\Repositories\QuestionRepositoryInterface;

readonly class QuestionController
{
    use ReadableResource;
    public function __construct(
        private QuestionRepositoryInterface $repository,
    ){

    }
}
