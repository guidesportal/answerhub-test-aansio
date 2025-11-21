<?php

namespace App\Infrastructure\Eloquent\Repositories;

use App\Models\Survey;
use App\Repositories\SurveyRepositoryInterface;
use Illuminate\Support\Collection;

class EloquentSurveyRepository implements SurveyRepositoryInterface
{
    public function find(int $id): ?Survey
    {
        return Survey::find($id);
    }

    public function list(): Collection
    {
        return collect(Survey::query()->where('is_active', true)->get());
    }
}
