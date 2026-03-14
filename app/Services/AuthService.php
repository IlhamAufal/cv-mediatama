<?php

namespace App\Services;

class AuthService
{
    /**
     * Validation rules for login.
     */
    public static function loginRules(): array
    {
        return [
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ];
    }

    /**
     * Custom validation messages for login.
     */
    public static function loginMessages(): array
    {
        return [
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ];
    }
}
