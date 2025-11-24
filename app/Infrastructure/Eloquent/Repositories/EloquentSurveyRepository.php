<?php

namespace App\Infrastructure\Eloquent\Repositories;

use App\Models\Survey;
use App\Repositories\SurveyRepositoryInterface;
use Illuminate\Support\Collection;

class EloquentSurveyRepository implements SurveyRepositoryInterface
{
    public function find(string $title): ?Survey
    {
        return Survey::where('title', $title)->first();
    }

    public function list(?array $with = []): Collection
    {
        return collect(Survey::with($with)->where('is_active', true)->get());
    }
}
