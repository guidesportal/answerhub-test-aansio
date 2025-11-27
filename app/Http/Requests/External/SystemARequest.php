<?php

namespace App\Http\Requests\External;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class SystemARequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'survey' => 'required|string',
            'email' => 'required|email',
            'qid' => 'required_without:q|integer',
            'q' => 'required_without:qid|integer',
            'score' => 'nullable|string',
            'submitted_at' => 'nullable|date',
        ];
    }
}

