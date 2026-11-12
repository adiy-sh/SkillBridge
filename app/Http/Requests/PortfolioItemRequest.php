<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PortfolioItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->isFreelancer();
    }

    public function rules(): array
    {
        $types = array_keys(config('skillbridge.portfolio_types'));

        return [
            'title'       => ['required', 'string', 'max:255'],
            'type'        => ['required', Rule::in($types)],
            'description' => ['nullable', 'string'],
            'url'         => ['nullable', 'url', 'max:2048'],
            'file'        => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
            'sort_order'  => ['nullable', 'integer', 'min:0'],
        ];
    }
}

