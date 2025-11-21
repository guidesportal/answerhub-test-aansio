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
    public function list(): Collection;

    public function firstBySurveyIdAndQuestionId(int $surveyId, int $questionId): ?Answer;

    /**
     * @param int $surveyId
     * @param int $questionId
     * @return Collection<Answer>
     */
    public function findBySurveyIdAndQuestionId(int $surveyId, int $questionId): Collection;

    public function create(array $answerData): ?Answer;
}
