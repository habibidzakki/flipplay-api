<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UpdateMediaRequest extends BaseMediaRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => [
                'sometimes',
                'required',
                'string',
                'max:255',
                Rule::unique('media', 'title')->ignore($this->route('media')),
            ],
            'type' => ['sometimes', 'required', 'string', 'max:50'],
            'genre' => ['sometimes', 'required', 'string', 'max:100'],
            'episodes' => ['sometimes', 'nullable', 'integer', 'min:1'],
            'release_year' => ['sometimes', 'nullable', 'integer', 'min:1900', 'max:2030'],
            'rating' => ['sometimes', 'nullable', 'numeric', 'min:0', 'max:10'],
            'description' => ['sometimes', 'nullable', 'string'],
        ];
    }
}
