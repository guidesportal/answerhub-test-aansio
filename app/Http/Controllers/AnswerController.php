<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\ReadableResource;
use App\Repositories\AnswerRepositoryInterface;

readonly class AnswerController
{
    use ReadableResource;
    public function __construct(
        private AnswerRepositoryInterface $repository,
    ){

    }



}
