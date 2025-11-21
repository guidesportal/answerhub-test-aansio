<?php

namespace App\Repositories;

use App\Models\Survey;
use Illuminate\Support\Collection;

interface SurveyRepositoryInterface
{
    public function find(int $id): ?Survey;

    /**
     * @return Collection<Survey>
     */
    public function list(): Collection;

}
