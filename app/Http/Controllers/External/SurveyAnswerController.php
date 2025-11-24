<?php

namespace App\Http\Controllers\External;

use App\Http\Requests\External\SystemARequest;
use App\Http\Requests\External\SystemBRequest;
use App\Http\Requests\External\SystemCRequest;
use App\Http\Requests\External\SystemFRequest;
use App\Services\Surveys\SurveyAnswerServiceInterface;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SurveyAnswerController
{
    public function __construct(
        private SurveyAnswerServiceInterface $surveyAnswerService
    ) {
    }

    public function systemA(SystemARequest $request): JsonResponse
    {
        try {
            $data = $request->json()->all();

            $email = $data['email'];
            $surveyId = $data['survey'];
            $questionId = (int) ($data['qid'] ?? $data['q']);
            $answer = (string) ($data['score'] ?? '');
            $answeredAt = isset($data['submitted_at']) 
                ? Carbon::parse($data['submitted_at'])->toDateTime()
                : now();

            $answers = [[
                'question_id' => $questionId,
                'answer' => $answer,
                'answered_at' => $answeredAt,
            ]];

            $result = $this->surveyAnswerService->perform($email, $surveyId, $answers);

            return response()->json(['success' => $result], $result ? 200 : 400);
        } catch (\Exception $e) {
            Log::error('SystemA error: ' . $e->getMessage());
            return response()->json(['error' => 'Invalid request'], 400);
        }
    }

    public function systemB(SystemBRequest $request): JsonResponse
    {
        try {
            $data = $request->json()->all();

            $email = $data['participant']['email'];
            $surveyId = $data['survey_code'];
            $questionId = (int) $data['external_qid'];
            $answer = (string) ($data['rating']['value'] ?? '');
            $answeredAt = isset($data['created_at']) 
                ? Carbon::createFromTimestamp($data['created_at'])->toDateTime()
                : now();

            $answers = [[
                'question_id' => $questionId,
                'answer' => $answer,
                'answered_at' => $answeredAt,
            ]];

            $result = $this->surveyAnswerService->perform($email, $surveyId, $answers);

            return response()->json(['success' => $result], $result ? 200 : 400);
        } catch (\Exception $e) {
            Log::error('SystemB error: ' . $e->getMessage());
            return response()->json(['error' => 'Invalid request'], 400);
        }
    }

    public function systemC(SystemCRequest $request): JsonResponse
    {
        try {
            $data = $request->json()->all();

            $email = $data['email_recipient'] . '@' . $data['email_host'];
            $surveyId = $data['survey']['surveyId'];
            $questionId = (int) $data['survey']['questionId'];
            $answer = (string) ($data['answer'] ?? '');
            
            $answeredAt = isset($data['submitted']) 
                ? Carbon::createFromFormat('d/m/Y H:i', $data['submitted'])->toDateTime()
                : now();

            $answers = [[
                'question_id' => $questionId,
                'answer' => $answer,
                'answered_at' => $answeredAt,
            ]];

            $result = $this->surveyAnswerService->perform($email, $surveyId, $answers);

            return response()->json(['success' => $result], $result ? 200 : 400);
        } catch (\Exception $e) {
            Log::error('SystemC error: ' . $e->getMessage());
            return response()->json(['error' => 'Invalid request'], 400);
        }
    }

    public function systemD(Request $request): JsonResponse
    {
        try {
            $xmlContent = $request->getContent();
            $xml = simplexml_load_string($xmlContent);

            if ($xml === false) {
                return response()->json(['error' => 'Invalid XML'], 400);
            }

            $email = (string) $xml->participant;
            $surveyId = (string) $xml->survey;
            $questionId = (int) $xml->question;
            $answer = (string) ($xml->score ?? '');
            $answeredAt = isset($xml->date) 
                ? Carbon::parse((string) $xml->date)->toDateTime()
                : now();

            $answers = [[
                'question_id' => $questionId,
                'answer' => $answer,
                'answered_at' => $answeredAt,
            ]];

            $result = $this->surveyAnswerService->perform($email, $surveyId, $answers);

            return response()->json(['success' => $result], $result ? 200 : 400);
        } catch (\Exception $e) {
            Log::error('SystemD error: ' . $e->getMessage());
            return response()->json(['error' => 'Invalid request'], 400);
        }
    }

    public function systemE(Request $request): JsonResponse
    {
        try {
            $csvContent = $request->getContent();
            $lines = explode("\n", trim($csvContent));
            
            if (empty($lines)) {
                return response()->json(['error' => 'Empty CSV'], 400);
            }

            $answers = [];
            $email = null;
            $surveyId = null;

            foreach ($lines as $line) {
                $line = trim($line);
                if (empty($line)) {
                    continue;
                }

                $fields = str_getcsv($line);
                if (count($fields) < 5) {
                    continue;
                }

                $questionId = (int) $fields[0];
                $currentSurveyId = $fields[1];
                $currentEmail = trim($fields[2], '"');
                $answer = trim($fields[3], '"');
                $dateStr = trim($fields[4], '"');

                if ($email === null) {
                    $email = $currentEmail;
                }
                if ($surveyId === null) {
                    $surveyId = $currentSurveyId;
                }

                $answeredAt = Carbon::createFromFormat('Y/m/d H:i', $dateStr)->toDateTime();

                $answers[] = [
                    'question_id' => $questionId,
                    'answer' => $answer,
                    'answered_at' => $answeredAt,
                ];
            }

            if (empty($answers) || $email === null || $surveyId === null) {
                return response()->json(['error' => 'Invalid CSV format'], 400);
            }

            $result = $this->surveyAnswerService->perform($email, $surveyId, $answers);

            return response()->json(['success' => $result], $result ? 200 : 400);
        } catch (\Exception $e) {
            Log::error('SystemE error: ' . $e->getMessage());
            return response()->json(['error' => 'Invalid request'], 400);
        }
    }

    public function systemF(SystemFRequest $request): JsonResponse
    {
        try {
            $email = $request->query('email');
            $surveyId = $request->query('survey');
            $questionId = (int) $request->query('question_id');
            $answer = (string) ($request->query('answer') ?? '');
            $answeredAt = $request->query('answered_at') 
                ? Carbon::parse($request->query('answered_at'))->toDateTime()
                : now();

            $answers = [[
                'question_id' => $questionId,
                'answer' => $answer,
                'answered_at' => $answeredAt,
            ]];

            $result = $this->surveyAnswerService->perform($email, $surveyId, $answers);

            return response()->json(['success' => $result], $result ? 200 : 400);
        } catch (\Exception $e) {
            Log::error('SystemF error: ' . $e->getMessage());
            return response()->json(['error' => 'Invalid request'], 400);
        }
    }
}
