<?php

namespace App\Services\Surveys;

interface SurveyAnswerServiceInterface
{
    /**
     * Process survey answers.
     *
     * @param string $email User email
     * @param string $surveyId Survey ID
     * @param array $answers Array of answers with format [['question_id' => int, 'answer' => string, 'answered_at' => DateTimeInterface]]
     * @return bool
     */
    public function perform(string $email, string $surveyId, array $answers): bool;
}
