<?php

namespace App\Services;

class VolunteerService
{
    /**
     * Validation rules for submitting a volunteer application.
     */
    public static function storeRules(): array
    {
        return [
            'skills' => ['nullable', 'array'],
            'skills.*' => ['string', 'max:50'],
            'availability' => ['nullable', 'array'],
            'availability.*' => ['in:senin,selasa,rabu,kamis,jumat,sabtu,minggu'],
            'motivation' => ['required', 'string', 'min:50', 'max:1000'],
            'experience' => ['nullable', 'string', 'max:1000'],
        ];
    }

    /**
     * Custom validation messages (Indonesian).
     */
    public static function messages(): array
    {
        return [
            'skills.*.max' => 'Setiap keahlian maksimal 50 karakter.',
            'availability.*.in' => 'Salah satu hari ketersediaan tidak valid.',
            'motivation.required' => 'Motivasi menjadi relawan wajib diisi.',
            'motivation.min' => 'Motivasi minimal harus 50 karakter.',
            'motivation.max' => 'Motivasi maksimal 1000 karakter.',
            'experience.max' => 'Pengalaman relawan maksimal 1000 karakter.',
        ];
    }
}
