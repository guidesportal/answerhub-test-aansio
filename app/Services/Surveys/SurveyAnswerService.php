<?php

namespace App\Services\Surveys;

use App\Repositories\UserRepositoryInterface;
use App\Repositories\SurveyRepositoryInterface;
use App\Repositories\QuestionRepositoryInterface;
use App\Repositories\AnswerRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SurveyAnswerService
{
    public function __construct(
        private readonly UserRepositoryInterface     $userRepo,
        private readonly SurveyRepositoryInterface   $surveyRepo,
        private readonly QuestionRepositoryInterface $questionRepo,
        private readonly AnswerRepositoryInterface   $answerRepo
    )
    {
    }

    /**
     * Process survey answers.
     *
     * @param string $email User email
     * @param string $surveyId Survey ID
     * @param array $answers Array of answers with format [['question_id' => int, 'answer' => string, 'answered_at' => DateTimeInterface]]
     * @return bool
     */
    public function perform(string $email, string $surveyId, array $answers): bool
    {
        return $this->realPerform($email, $surveyId, $answers);
    }

    /**
     * Save survey answers.
     *
     * @param string $email
     * @param int $surveyId
     * @param array $answers [['question_id' => int, 'answer' => string]]
     * @return bool
     */
    private function realPerform(string $email, int $surveyId, array $answers): bool
    {
        return DB::transaction(function () use ($email, $surveyId, $answers) {

            $user = $this->userRepo->findByEmail($email);
            if (!$user) {
                Log::warning("User {$email} not found");
                return false;
            }

            $survey = $this->surveyRepo->find($surveyId);
            if (!$survey) {
                Log::warning("Survey {$surveyId} not found");
                return false;
            }

            foreach ($answers as $answerData) {
                $question = $this->questionRepo->firstBySurveyIdAndQuestionId($surveyId, $answerData['question_id']);

                if (!$question) {
                    Log::warning("Question {$answerData['question_id']} not found in survey {$surveyId}");
                    continue; // skip invalid question
                }

                $this->answerRepo->create([
                    'user_id' => $user->id,
                    'survey_id' => $surveyId,
                    'question_id' => $question->id,
                    'answer' => $answerData['answer'],
                ]);
            }

            return true;
        });
    }
}
