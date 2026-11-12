<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProjectDiscoveryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        $categories       = array_keys(config('skillbridge.categories'));
        $experienceLevels = array_keys(config('skillbridge.experience_levels'));
        $workArrangements = array_keys(config('skillbridge.work_arrangements'));
        $sortOptions      = ['budget_asc', 'budget_desc', 'deadline_asc', 'newest'];

        return [
            'budget_min'       => ['nullable', 'numeric', 'min:0'],
            'budget_max'       => ['nullable', 'numeric', 'min:0'],
            'category'         => ['nullable', Rule::in($categories)],
            'deadline_before'  => ['nullable', 'date'],
            'experience_level' => ['nullable', Rule::in($experienceLevels)],
            'work_arrangement' => ['nullable', Rule::in($workArrangements)],
            'sort'             => ['nullable', Rule::in($sortOptions)],
        ];
    }
}

