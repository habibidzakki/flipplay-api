<?php

namespace App\Http\Requests;

class StoreMediaRequest extends BaseMediaRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255', 'unique:media,title'],
            'type' => ['required', 'string', 'max:50'],
            'genre' => ['required', 'string', 'max:100'],
            'episodes' => ['nullable', 'integer', 'min:1'],
            'release_year' => ['nullable', 'integer', 'min:1900', 'max:2030'],
            'rating' => ['nullable', 'numeric', 'min:0', 'max:10'],
            'description' => ['nullable', 'string'],
        ];
    }
}
