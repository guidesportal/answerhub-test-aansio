<?php

namespace App\Infrastructure\Eloquent\Repositories;

use App\Models\Question;
use App\Repositories\QuestionRepositoryInterface;
use Illuminate\Support\Collection;

class EloquentQuestionRepository implements QuestionRepositoryInterface
{
    public function find(int $id): ?Question
    {
        return Question::find($id);
    }

    public function list(?array $with = []): Collection
    {
        return collect(Question::with($with)->get());
    }

    public function firstBySurveyAndQuestionId(string $surveyId, int $questionId): ?Question
    {
        return Question::where('survey', $surveyId)
            ->where('id', $questionId)
            ->first();
    }
}
