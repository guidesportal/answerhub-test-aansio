<?php

namespace App\Repositories;

use App\Models\Survey;
use Illuminate\Support\Collection;

interface SurveyRepositoryInterface
{
    public function find(string $title): ?Survey;

    /**
     * @return Collection<Survey>
     */
    public function list(?array $with = []): Collection;

}
