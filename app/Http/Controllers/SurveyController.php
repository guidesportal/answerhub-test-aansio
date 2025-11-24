<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\ReadableResource;
use App\Repositories\SurveyRepositoryInterface;

readonly class SurveyController
{
    use ReadableResource;
    public function __construct(
        private SurveyRepositoryInterface $repository,
    ) {

    }
}
