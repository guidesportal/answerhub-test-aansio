<?php

namespace App\Infrastructure\Eloquent\Repositories;

use App\Models\Question;
use App\Models\Survey;
use App\Repositories\QuestionRepositoryInterface;
use Illuminate\Support\Collection;

class EloquentQuestionRepository implements QuestionRepositoryInterface
{
    public function find(int $id): ?Question
    {
        return Question::find($id);
    }

    public function list(): Collection
    {
        return collect(Question::all());
    }

}
