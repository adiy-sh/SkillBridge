<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->isClient();
    }

    public function rules(): array
    {
        $categories       = array_keys(config('skillbridge.categories'));
        $experienceLevels = array_keys(config('skillbridge.experience_levels'));
        $workArrangements = array_keys(config('skillbridge.work_arrangements'));

        return [
            'title'            => ['required', 'string', 'max:255'],
            'description'      => ['nullable', 'string'],
            'budget'           => ['nullable', 'numeric', 'min:0'],
            'deadline'         => ['nullable', 'date', 'after_or_equal:today'],
            'category'         => ['nullable', Rule::in($categories)],
            'experience_level' => ['nullable', Rule::in($experienceLevels)],
            'work_arrangement' => ['nullable', Rule::in($workArrangements)],
            'skills'           => ['nullable', 'array'],
            'skills.*'         => ['integer', 'exists:skills,id'],
            'min_proficiency'  => ['nullable', 'array'],
            'min_proficiency.*'=> ['nullable', 'integer', 'min:1', 'max:5'],
        ];
    }
}

