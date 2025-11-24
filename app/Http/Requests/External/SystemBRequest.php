<?php

namespace App\Http\Requests\External;

use Illuminate\Foundation\Http\FormRequest;

class SystemBRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'survey_code' => 'required|string',
            'participant.email' => 'required|email',
            'external_qid' => 'required|integer',
            'rating.value' => 'nullable|string',
            'created_at' => 'nullable|integer',
        ];
    }
}

