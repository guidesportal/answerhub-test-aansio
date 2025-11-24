<?php

namespace App\Infrastructure\Eloquent\Repositories;

use App\Models\Answer;
use App\Repositories\AnswerRepositoryInterface;
use Illuminate\Support\Collection;

class EloquentAnswerRepository implements AnswerRepositoryInterface
{
    public function find(int $id): ?Answer
    {
        return Answer::find($id);
    }

    public function list(?array $with = []): Collection
    {
        return collect(Answer::with($with)->get());
    }

    public function findBySurveyAndQuestionId(int $surveyId, int $questionId): Collection
    {
        $eloquentCollection = Answer::query()
            ->where('survey_id', $surveyId)
            ->where('question_id', $questionId)
            ->get();

        return collect($eloquentCollection);
    }

    public function firstBySurveyAndQuestionId(int $surveyId, int $questionId): ?Answer
    {
        return Answer::query()
            ->where('question_id', '=', $questionId)
            ->where('survey_id', '=', $surveyId)
            ->first();
    }

    public function create(array $answerData): ?Answer
    {
        $answer = new Answer();
        $answer->user_id = $answerData['user_id'];
        $answer->survey_id = $answerData['survey_id'];
        $answer->question_id = $answerData['question_id'];
        $answer->answer = $answerData['answer'];
        $answer->answered_at = $answerData['answered_at'];
        $answer->save();
        return $answer;
    }

}
