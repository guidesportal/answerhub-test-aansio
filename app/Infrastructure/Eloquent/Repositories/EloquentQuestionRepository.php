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

    public function firstBySurveyAndQuestionId(string $survey, int $questionId): ?Question
    {
        $question = $this->find($questionId);
        return ($question->survey === $survey) ? $question : null;
    }
}
