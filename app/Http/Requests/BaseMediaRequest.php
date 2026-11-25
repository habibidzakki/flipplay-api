<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class BaseMediaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get custom validation messages in Indonesian.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Judul media wajib diisi.',
            'title.string' => 'Judul media harus berupa teks.',
            'title.max' => 'Judul media maksimal 255 karakter.',
            'title.unique' => 'Judul media sudah terdaftar.',
            'type.required' => 'Tipe media wajib diisi.',
            'type.string' => 'Tipe media harus berupa teks.',
            'type.max' => 'Tipe media maksimal 50 karakter.',
            'genre.required' => 'Genre media wajib diisi.',
            'genre.string' => 'Genre media harus berupa teks.',
            'genre.max' => 'Genre media maksimal 100 karakter.',
            'episodes.integer' => 'Jumlah episode harus berupa bilangan bulat.',
            'episodes.min' => 'Jumlah episode minimal 1.',
            'release_year.integer' => 'Tahun rilis harus berupa bilangan bulat.',
            'release_year.min' => 'Tahun rilis minimal 1900.',
            'release_year.max' => 'Tahun rilis maksimal 2030.',
            'rating.numeric' => 'Rating harus berupa angka.',
            'rating.min' => 'Rating minimal 0.',
            'rating.max' => 'Rating maksimal 10.',
            'description.string' => 'Deskripsi media harus berupa teks.',
        ];
    }
}
