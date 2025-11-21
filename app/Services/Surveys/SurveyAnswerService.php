<?php

namespace App\Services\Surveys;

use App\Repositories\UserRepositoryInterface;
use App\Repositories\SurveyRepositoryInterface;
use App\Repositories\QuestionRepositoryInterface;
use App\Repositories\AnswerRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SurveyAnswerService implements SurveyAnswerServiceInterface
{
    public function __construct(
        private UserRepositoryInterface     $userRepo,
        private SurveyRepositoryInterface   $surveyRepo,
        private QuestionRepositoryInterface $questionRepo,
        private AnswerRepositoryInterface   $answerRepo
    ) {
    }

    /*
    * Here we can expect a bunch of arguments, or a typed object or simply stdClass obj... Whatever
    * Depending on how do you implement the code flow between SurveyAnswerController and this service method
    * It's up to you to directly call this perform() method directly from the controller
    * or from a job, or any other flow but this is the only method you are allowed to edit on this file
    */
    public function perform(): bool
    {
        // TODO implement your code in a way that finally you can call the realPerform() method
        // Sample, the final line of that method will be like:
        // $this->realPerform($userId, $surveyId, $answers);
        return true;
    }

    /**
     * Save survey answers.
     *
     * @param string $email
     * @param string $surveyId
     * @param array $answers [['question_id' => int, 'answer' => string, 'answered_at' => DateTimeInterface]]
     * @return bool
     */
    private function realPerform(string $email, string $surveyId, array $answers): bool
    {
        $allFine = true;
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
            $question = $this->questionRepo->firstBySurveyAndQuestionId($surveyId, $answerData['question_id']);

            if (!$question) {
                $allFine = false;
                Log::warning("Question {$answerData['question_id']} not found in survey {$surveyId}");
                continue; // skip invalid question
            }

            $this->answerRepo->create([
                'user_id' => $user->id,
                'survey' => $surveyId,
                'question_id' => $question->id,
                'answer' => $answerData['answer'],
                'answered_at' => $answerData['answered_at'],
            ]);
        }

        return $allFine;
    }
}
