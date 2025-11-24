<?php

namespace App\Http\Requests\External;

use Illuminate\Foundation\Http\FormRequest;

class SystemCRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'survey.surveyId' => 'required|string',
            'survey.questionId' => 'required|integer',
            'email_recipient' => 'required|string',
            'email_host' => 'required|string',
            'answer' => 'nullable|string',
            'submitted' => 'nullable|string',
        ];
    }
}

