<?php

namespace App\Repositories;

use App\Models\Answer;
use Illuminate\Support\Collection;

interface AnswerRepositoryInterface
{
    public function find(int $id): ?Answer;

    /**
     * @return Collection<Answer>
     */
    public function list(?array $with = []): Collection;

    public function firstBySurveyAndQuestionId(string $survey, int $questionId): ?Answer;

    /**
     * @param string $survey
     * @param int $questionId
     * @return Collection<Answer>
     */
    public function findBySurveyAndQuestionId(string $survey, int $questionId): Collection;

    public function create(array $answerData): ?Answer;
}
