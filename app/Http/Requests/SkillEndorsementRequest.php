<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SkillEndorsementRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Any authenticated user may attempt; policy checks ownership in controller
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'user_skill_id' => ['required', 'integer', 'exists:user_skills,id'],
            'note'          => ['nullable', 'string', 'max:500'],
        ];
    }
}

