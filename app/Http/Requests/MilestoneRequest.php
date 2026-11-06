<?php

namespace App\Http\Requests;

use App\Models\Milestone;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MilestoneRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // access is checked in the controller
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'acceptance_criteria' => ['required', 'string'],
            'amount' => ['nullable', 'numeric', 'min:0'],
            'due_date' => ['required', 'date'],
            'status' => ['required', Rule::in(Milestone::STATUSES)],
            'dependencies' => ['nullable', 'array'],
            'dependencies.*' => ['integer', 'exists:milestones,id'],
        ];
    }
}