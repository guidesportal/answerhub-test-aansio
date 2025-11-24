<?php

namespace App\Http\Requests\External;

use Illuminate\Foundation\Http\FormRequest;

class SystemFRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'survey' => 'required|string',
            'question_id' => 'required|integer',
            'answer' => 'nullable|string',
            'answered_at' => 'nullable|date',
        ];
    }
}

